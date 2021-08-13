<script src="https://cdn.tiny.cloud/1/tqy2zumq94vxsgjdp9lmqp9ejscp13fxux17f0c0n2o34s9q/tinymce/5/tinymce.min.js"
referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: 'textarea.bodyfield',
        height: 300,
        menubar: false,
        plugins: ['link', 'table', 'image', 'autosize', 'lists'],
        toolbar: 'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | table | link image | bullist numlist',
        content_css: [
            '{{ asset('assets/css/content.css') }}'
        ],
        images_upload_url: '{{ route('imageupload') }}',
        images_upload_credentials: true,
        convert_urls: false,
        skin: 'oxide-dark',
        content_css: 'dark'
    });
</script>
