<?php

namespace App\Services;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Promise\Promise;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Http;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class RabbitMQService {
    public function publish($message) {
        $connection = new AMQPStreamConnection(env('RABBITMQ_HOST'), env('RABBITMQ_PORT'), env('RABBITMQ_USER'), env('RABBITMQ_PASSWORD'), env('RABBITMQ_VHOST'));
        $channel = $connection->channel();
        $channel->queue_declare('test_queue', false, false, false, false);
        $msg = new AMQPMessage($message);
        $channel->basic_publish($msg, '', 'test_queue');
        echo " [x] Sent $message to test_exchange / test_queue.\n";
        $channel->close();
        $connection->close();
    }

    // public function consume() {
    //     $connection = new AMQPStreamConnection(env('RABBITMQ_HOST'), env('RABBITMQ_PORT'), env('RABBITMQ_USER'), env('RABBITMQ_PASSWORD'), env('RABBITMQ_VHOST'));
    //     $channel = $connection->channel();
    //      $callback = function ($msg) {
    //         echo ' [x] Received ', $msg->body, "\n";
    //     };
    //     $channel->queue_declare('test_queue', false, false, false, false);
    //     $channel->basic_consume('test_queue', '', false, true, false, false, $callback);
    //     echo 'Waiting for new message on test_queue', " \n";
    //     // while ($channel->is_consuming()) {
    //     //     $channel->wait();
    //     // }
    //     while(count($channel->callbacks) > 0){
    //         $channel->wait();
    //     }
    //     $channel->close();
    //     $connection->close();
    // }

    public function consume(){
        $reconnectDelay = 5; // Delay between reconnection attempts in seconds

        while (true) {
            try {
                // Establish connection to RabbitMQ
                $connection = new AMQPStreamConnection(
                    env('RABBITMQ_HOST'),
                    env('RABBITMQ_PORT'),
                    env('RABBITMQ_USER'),
                    env('RABBITMQ_PASSWORD'),
                    env('RABBITMQ_VHOST')
                );

                // Open a channel
                $channel = $connection->channel();

                // Declare the queue
                $channel->queue_declare('test_queue', false, false, false, false);

                // Define the callback function
                $callback = function ($msg) {
                    // Insert
                    // Http::withHeaders([
                    //     "Accept" => "application/json",
                    // ])->timeout(20)->post("http://127.0.0.1:5000/text-to-speech", [
                    //     "text" => $msg->body
                    // ]);
                    $client = new Client(
                        ['base_uri' => 'http://127.0.0.1:5000']
                    );
                    $headers = ['Accept' => 'application/json'];
                    $body = $msg->body;
                    echo ' [x] Received ', $msg->body, "\n";
                    $request = new Request('POST', '"http://127.0.0.1:5000/text-to-speech', $headers, $body);
                    $promise = new Promise(
                        function () use ($client, $request) {
                            return $client->sendAsync($request);
                        }
                    );
                    $promise->wait();
                };

                // Consume messages from the queue
                $channel->basic_consume('test_queue', '', false, true, false, false, $callback);

                echo 'Waiting for new message on test_queue', "\n";

                // Wait for messages
                while (count($channel->callbacks)) {
                    $channel->wait(null, false, 86_400); // Set timeout to 30 seconds
                }

                // Close the channel and the connection
                $channel->close();
                $connection->close();
            } catch (\PhpAmqpLib\Exception\AMQPTimeoutException $e) {
                echo 'Timeout Error: ', $e->getMessage(), "\n";
            } catch (\PhpAmqpLib\Exception\AMQPRuntimeException $e) {
                echo 'Runtime Error: ', $e->getMessage(), "\n";
            } catch (Exception $e) {
                echo 'Error: ', $e->getMessage(), "\n";
            }

            // Wait before attempting to reconnect
            echo "Attempting to reconnect in {$reconnectDelay} seconds...\n";
            sleep($reconnectDelay);
        }
    }
}