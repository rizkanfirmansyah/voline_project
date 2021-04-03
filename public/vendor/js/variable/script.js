const csrftoken = $('meta[name="csrf-token"]').data('token')
$(document).ready(function() {

    $('.image-input-preview').change(function(){
        let id = $(this).data('id')
        let reader = new FileReader();

        reader.onload = (e) => {

          $(`#${id}`).attr('src', e.target.result);
        }

        reader.readAsDataURL(this.files[0]);

    });
})
