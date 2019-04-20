    <script>

        toastr.options = {
            closeButton: true,
            progressBar: true,
            showMethod: 'slideDown',
            timeOut: 5000
        };

        @if(\Session::has('error'))
            toastr.error('{!! \Session::get('error') !!}', 'Error');
        @endif
        @if(\Session::has('success'))
            toastr.success('{!! \Session::get('success') !!}', 'Success');
        @endif

        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>

        function deleteRecordByAjax(deleteUrl, moduleName, dataTablesName) {
            var deleteAlertStr = "You want to delete "+moduleName+"?";

            swal({
                    title: "Are you sure?",
                    text: deleteAlertStr,
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes, Remove it!",
                    cancelButtonText: "No, cancel!",
                    showLoaderOnConfirm: true,
                    allowOutsideClick:false,
                    allowEscapeKey:false,
                    preConfirm: function (email) {
                        return new Promise(function (resolve, reject) {
                            setTimeout(function() {
                                jQuery.ajax({
                                    url: deleteUrl,
                                    type: 'DELETE',
                                    dataType: 'json',
                                    data: {
                                        "_token": window.Laravel.csrfToken
                                    },
                                    success: function (result) {
                                        dataTablesName.draw();
                                        swal("success!", moduleName+" Deleted successfully.", "success");
                                        fnToastSuccess(result.message);
                                    },
                                    error: function (xhr, status, error) {
                                        if(xhr.responseJSON && xhr.responseJSON.message!=""){
                                            swal("ohh snap!", xhr.responseJSON.message, "error");
                                        } else {
                                            swal("ohh snap!", "Something went wrong", "error");
                                        }
                                        ajaxError(xhr, status, error);
                                    }
                                });
                            }, 0)
                        })
                    },
                });
        }

        function subscriptionByAjax(deleteUrl, moduleName, dataTablesName) {
            var deleteAlertStr = "You want to "+moduleName+"?";

            swal({
                    title: "Are you sure?",
                    text: deleteAlertStr,
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes!",
                    cancelButtonText: "No!",
                    showLoaderOnConfirm: true,
                    allowOutsideClick:false,
                    allowEscapeKey:false,
                    preConfirm: function (email) {
                        return new Promise(function (resolve, reject) {
                            setTimeout(function() {
                                jQuery.ajax({
                                    url: deleteUrl,
                                    type: 'get',
                                    dataType: 'json',
                                    data: {
                                        "_token": window.Laravel.csrfToken
                                    },
                                    success: function (result) {
                                        dataTablesName.draw();
                                        swal("success!", moduleName+" successfully.", "success");
                                        fnToastSuccess(result.message);
                                    },
                                    error: function (xhr, status, error) {
                                        if(xhr.responseJSON && xhr.responseJSON.message!=""){
                                            swal("ohh snap!", xhr.responseJSON.message, "error");
                                        } else {
                                            swal("ohh snap!", "Something went wrong", "error");
                                        }
                                        ajaxError(xhr, status, error);
                                    }
                                });
                            }, 0)
                        })
                    },
                });
        }

        function fnToastSuccess(message) {
            toastr.options = {
                closeButton: true,
                progressBar: true,
                showMethod: 'slideDown',
                timeOut: 4000
            };
            toastr.success(message);
        }

        function fnToastError(message) {
            toastr.options = {
                closeButton: true,
                progressBar: true,
                showMethod: 'slideDown',
                timeOut: 4000
            };
            toastr.error(message);
        }

        function ajaxError(xhr, status, error) {
            if(xhr.status ==401){
                fnToastError("You are not logged in. please login and try again");
            }else if(xhr.status == 403){
                fnToastError("You have not permission for perform this operations");
            }else if(xhr.responseJSON && xhr.responseJSON.message!=""){
                fnToastError(xhr.responseJSON.message);
            }else{
                fnToastError("Something went wrong , Please try again later.");
            }
        }

        function displayImageOnFileSelect(input, thumbElement) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $(thumbElement).attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        function nl2br (str, is_xhtml) {
            var breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '<br />' : '<br>';
            return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1' + breakTag + '$2');
        }

        function convertToSlug(Text)
{
            return Text
                .toLowerCase()
                .replace(/ /g,'-')
                .replace(/[^\w-]+/g,'')
                ;
        }


    </script>
