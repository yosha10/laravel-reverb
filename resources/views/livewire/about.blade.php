<div>
    About: The whole world belongs to you.

    <div class="container-fluid">
        <h2>No Dokter</h2>
        <hr>
        <div class="row">
            <div class="col-md-8">
                <h1>{{ now() }}</h1>
                {{-- <h2>Count: {{ $count }}</h2> --}}
                <h3 class="mx-4">Poli Umum</h3>
                <div class="scroller" data-speed="slow">
                    <ul class="tag-list scroller__inner">
                        <h1 class="text-3xl font-bold underline text-blue-500">
                            Hello world!
                        </h1>
                        @foreach ($antrian as $item)
                            <li>
                                <div class="card border-secondary text-bg-light mb-3 text-center"
                                    style="max-width: 18rem;">
                                    <div class="row g-0">
                                        <div class="col-md-2">
                                            <div class="card-header fs-1 h-100 p-2">
                                                {{ $item->id }}
                                            </div>
                                        </div>
                                        <div class="col-md-10">
                                            <div class="card-body">
                                                <div class="row justify-content-md-center">
                                                    <div class="col-md-8">
                                                        <h3>Antrean</h3>
                                                        <p>0000{{ $item->id }}{{ $item->name }}</p>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <p>Room 202</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
                {{-- <div class="card border-secondary w-50">
                    @foreach ($data as $item)
                        <div class="card border-secondary text-bg-light mb-3 text-center" style="max-width: 18rem;">
                            <div class="row g-0">
                                <div class="col-md-2">
                                    <div class="card-header fs-1 h-100 p-2">
                                        {{ $item->id }}
                                    </div>
                                </div>
                                <div class="col-md-10">
                                    <div class="card-body">
                                        <div class="row justify-content-md-center">
                                            <div class="col-md-8">
                                                <h3>Antrean</h3>
                                                <p>0000{{ $item->id }}{{ $item->name }}</p>
                                            </div>
                                            <div class="col-md-4">
                                                <p>Room 202</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div> --}}
            </div>

            <div class="col-md-4">
                <h3 class="mx-4">Dokter Belum Praktik</h3>
                @for ($i = 1; $i < 5; $i++)
                    <div class="card border-secondary text-bg-light mb-3 text-center" style="max-width: 18rem;">
                        <div class="row g-0">
                            <div class="col-md-2">
                                <div class="card-header fs-1 h-100 p-2">
                                    1
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="card-body">
                                    <div class="row justify-content-md-center">
                                        <div class="col-md-8">
                                            <h3>Antrean</h3>
                                            <p>0001</p>
                                        </div>
                                        <div class="col-md-4">
                                            <p>Room 202</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endfor
            </div>
        </div>
    </div>
    @push('js')
        <script>
            setInterval(() => Livewire.dispatch('ubahData'), 3000);
            var data = JSON.parse(`<?php echo $users; ?>`);
            console.log(data);
            Livewire.on('berhasilUpdate', event => {
                var data = JSON.parse(event.data);
                console.log(data);
            });
        </script>
    @endpush
</div>
