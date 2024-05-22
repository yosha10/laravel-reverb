<div>
    <div class="container mt-5 pt-5">
        <div class="row">
            <div class="col">
                <h2 class="mb-4">Send Realtime Message</h2>
                <form action="" class="form" wire:submit.prevent="triggerEvent">
                    <input type="text" wire:model="message" class="form-control" placeholder="Your Message">
                    <input type="submit" class="btn btn-primary mt-3">
                </form>
            </div>
        </div>
    </div>
</div>
