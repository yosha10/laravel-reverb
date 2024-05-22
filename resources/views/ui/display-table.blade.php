<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">First</th>
            <th scope="col">Last</th>
            <th scope="col">Handle</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th scope="row"><span onmouseover="show()">1</span></th>
            <td>Mark</td>
            <td>Otto</td>
            <td>@mdo</td>
        </tr>
        <tr>
            <th scope="row">2</th>
            <td>Jacob</td>
            <td>Thornton</td>
            <td>@fat</td>
        </tr>
        <tr>
            <th scope="row">3</th>
            <td colspan="2">Larry the Bird</td>
            <td>@twitter</td>
        </tr>
    </tbody>
</table>

<x-offcanvas />

@push('scripts')
    <script>
        // Show canvas
        function show() {
            const canvas = document.getElementById("staticBackdrop");
            canvas.classList.add("show");
        }

        // Button canvas close
        document.getElementById("btn-close").addEventListener("click", (x) => {
            x.preventDefault();
            gone();
        });

        // Get width canvas
        var width = document.getElementById('staticBackdrop').offsetWidth;

        document.addEventListener('mousemove', (event) => {
            if (event.x >= width) {
                gone();
            }
        });

        // Hide canvas
        function gone() {
            const canvas = document.getElementById("staticBackdrop");
            canvas.classList.remove("show");
        }
    </script>
@endpush
