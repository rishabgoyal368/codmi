$(document).ready(function() {

    $(document).on("click", ".changeStatus", function(e) {
        e.preventDefault();
        var url = $(this).attr('data-url');
        var name = 'User';
        // $(this).data("name")
        var formData = {
            'id': $(this).attr('data-id'),
            'status': $(this).attr('data-status'),
        };
        console.log(formData);
        swal({
                title: `Are you sure ?`,
                text: `you want to change status of this ${name}?`,
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: url,
                        type: "post",
                        data: formData,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(d) {
                            if (d.code == 200) {
                                location.reload();
                            } else {
                                swal(d.message)
                            }
                        }
                    });
                }
            });


    });
});