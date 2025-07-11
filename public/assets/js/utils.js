
function post(url,data, successCallback) {
    $.ajax({
        type: 'POST',
        url: url,
        data: JSON.stringify(data),
        dataType: 'JSON',
        beforeSend: function () {
            Swal.fire({
                allowOutsideClick: false,
                imageUrl: 'assets/img/Loading/loading.gif',
                imageHeight: 170,
                title: "Loading Data ...",
                html: "Please Wait while Data is being loaded.",
                showConfirmButton: false,
            });
        },
        success: successCallback,
        error: function (error) {

            console.log(error)
            Swal.fire({
                allowOutsideClick: false,
                title: "404",
                title: "Something Wrong!",
                html: `${JSON.stringify(error)}`,
                icon : 'warning',
            });
        }
    });
}

function get(url, successCallback) {
    $.ajax({
        type: 'GET',
        url: url,
        dataType: 'JSON',
        beforeSend: function () {
            Swal.fire({
                allowOutsideClick: false,
                imageUrl: 'assets/img/Loading/loading.gif',
                imageHeight: 170,
                title: "Loading Data ...",
                html: "Please Wait while Data is being loaded.",
                showConfirmButton: false,
            });
        },
        success: successCallback,
        error: function (error) {
            Swal.fire({
                allowOutsideClick: false,
                title: "404",
                title: "Something Wrong!",
                html: `${JSON.stringify(error)}`,
                icon : 'danger',
            });
        }
    });
}

function Message_Result(result){
    Swal.fire({
        icon: result.icon,
        title: result.tittle,
        text: result.Message,
    });
}

