$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function handleUpload(btn, form, method, dataArray) {
    $(document).off('click', `#${btn}`).on('click', `#${btn}`, function(e) {
        loading_show('indicator-label', 'overlay');
        e.preventDefault();
        let id = $('#id').val();
        let form_data = new FormData(document.getElementById(form));
        form_data.append('_method', method);
        if (dataArray !== undefined) {
            for (let i = 0; i < dataArray.length; i++) {
                let elementValue = dataArray[i];
                elementValue = $('#' + dataArray[i]).val();
                form_data.append(dataArray[i], elementValue);
            }
        }
        $.ajax({
            type: 'POST',
            url: $(`#${form}`).attr('action'),
            data: form_data,
            contentType: false,
            processData: false,
            success: function(res) {
                loading_hide('indicator-label', 'overlay');
                Swal.fire({
                    icon: 'success',
                    title: res.text,
                    showConfirmButton: false,
                    timer: 1500
                }).then((res) => {
                    var form_url = $(`#${form}`);
                    var redirectUrl = form_url.data('redirect-url');
                    window.location.href = redirectUrl;
                });
            },
            error: function(xhr) {
                loading_hide('indicator-label', 'overlay');
                iziToast.warning({
                    title: 'Failed',
                    message: xhr.responseJSON.text,
                });
            }
        });
    });
};

function loading_show(label, progress){
    $('.'+label).hide();
    $('.'+progress).show();
};
function loading_hide(label, progress){
    $('.'+label).show();
    $('.'+progress).hide();
};


function diffForHuman(date) {
    var seconds = Math.floor((new Date() - date) / 1000);
    var interval = Math.floor(seconds / 31536000);

    if (interval > 1) {
        return interval + " tahun yang lalu";
    }
    interval = Math.floor(seconds / 2592000);
    if (interval > 1) {
        return interval + " bulan yang lalu";
    }
    interval = Math.floor(seconds / 86400);
    if (interval > 1) {
        return interval + " hari yang lalu";
    }
    interval = Math.floor(seconds / 3600);
    if (interval > 1) {
        return interval + " jam yang lalu";
    }
    interval = Math.floor(seconds / 60);
    if (interval > 1) {
        return interval + " menit yang lalu";
    }
    return Math.floor(seconds) + " detik yang lalu";
}



