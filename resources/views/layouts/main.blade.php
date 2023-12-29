<!DOCTYPE html>
<html data-bs-theme="light" lang="en" data-bss-forced-theme="light">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, shrink-to-fit=no"
    />
    <title>{{ $title }}</title>
    <link
      href="https://unpkg.com/filepond/dist/filepond.css"
      rel="stylesheet"
    />

    <!-- Add plugin styles -->
    <link
      href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css"
      rel="stylesheet"
    />

    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css"
    />
    <link rel="stylesheet" href="../css/all.min.css" />
    <link rel="stylesheet" href="../css/OverlayScrollbars.min.css" />
    <link rel="stylesheet" href="../css/tiny-slider.css" />
    <link rel="stylesheet" href="../css/choices.min.css" />
    <link rel="stylesheet" href="../css/glightbox.min.css" />
    <link rel="stylesheet" href="../css/dropzone.css" />
    <link rel="stylesheet" href="../css/flatpickr.css" />
    <link rel="stylesheet" href="../css/plyr.css" />
    <link rel="stylesheet" href="../css/zuck.min.css" />
    <link rel="stylesheet" href="../css/style.css" />
  </head>
  <body>
    @include('partials.navbar')
    <main>
      @yield('content')
    </main>
    @yield('footer')
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
    <script src="https://unpkg.com/filepond/dist/filepond.js"></script>
    <script>
      FilePond.registerPlugin(
        // register the Image Crop plugin with FilePond
        FilePondPluginImagePreview
        );
        const inputElement = document.querySelector('input[type="file"]');
        const pond = FilePond.create(inputElement);
        const contentTextarea = document.getElementById('contentTextarea');
        const uploadButton = document.getElementById('uploadButton');
        contentTextarea.addEventListener('input', validateInputs);
        function validateInputs() {
          if (contentTextarea.value.trim() !== '') {
            uploadButton.removeAttribute('disabled');
            uploadButton.classList.remove('btn-secondary');
            uploadButton.classList.add('btn-primary');
          } else {
            uploadButton.setAttribute('disabled', 'disabled');
            uploadButton.classList.remove('btn-primary');
            uploadButton.classList.add('btn-secondary');
          }
        }
        </script>
    <script src="https://unpkg.com/feather-icons"></script>
    <script>
      feather.replace();
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>





