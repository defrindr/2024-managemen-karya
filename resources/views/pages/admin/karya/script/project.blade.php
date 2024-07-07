<script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>
<script>
    let editor;
    if (document.querySelector('#editor'))
        ClassicEditor
        .create(document.querySelector('#editor'))
        .then(newEditor => {
            editor = newEditor;
            editor.data.set(`{!! $detail ? $detail->deskripsi : '' !!}`);


            $('.ck.ck-button.ck-off.ck-file-dialog-button').hide();
            $('.ck.ck-button.ck-off.ck-dropdown__button').hide();
        })
        .catch(error => {
            console.error('ErrorBro', error);
        });


    // Assuming there is a <button id="submit">Submit</button> in your application.
    document.querySelector('#submit').addEventListener('click', () => {
        if (editor) {
            $('#input__deskripsi').val(editor.getData());
        }

        return confirm('Apakah anda yakin ingin menjalankan aksi ini ?')
    });
</script>
