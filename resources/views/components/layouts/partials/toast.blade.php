    <script>
        @if (session('success'))
            Toastify({
                text: "{{ session('success') }}",
                duration: 3000,
                close: true,
                gravity: "top",
                position: "right",
                stopOnFocus: true,
                style: {
                    background: "linear-gradient(to right, #28a745, #218838)",
                },
            }).showToast();
        @endif

        @if (session('error'))
            Toastify({
                text: "{{ session('error') }}",
                duration: 3000,
                close: true,
                gravity: "top",
                position: "right",
                stopOnFocus: true,
                style: {
                    background: "linear-gradient(to right, #dc3545, #c82333)",
                },
            }).showToast();
        @endif

        @if (session('info'))
            Toastify({
                text: "{{ session('info') }}",
                duration: 3000,
                close: true,
                gravity: "top",
                position: "right",
                stopOnFocus: true,
                style: {
                    background: "linear-gradient(to right, #17a2b8, #138496)",
                },
            }).showToast();
        @endif

        @if (session('warning'))
            Toastify({
                text: "{{ session('warning') }}",
                duration: 3000,
                close: true,
                gravity: "top",
                position: "right",
                stopOnFocus: true,
                style: {
                    background: "linear-gradient(to right, #ffc107, #e0a800)",
                    color: "#212529"
                },
            }).showToast();
        @endif
    </script>
