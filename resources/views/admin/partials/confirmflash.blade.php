@if(session()->has('flash_message'))
    <script>
        swal({
            type: "{{ session('flash_message.type')  }}",
            title: "",
            text: "{{ session('flash_message.text') }}",
            imageUrl: "{{ asset('images/thanksball.jpg') }}",
            imageSize: '200x200',
            showConfirmButton: true
        });
    </script>
@endif
