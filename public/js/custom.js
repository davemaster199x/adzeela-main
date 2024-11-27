// let idleTimeout;

// function resetIdleTimeout() {
//     clearTimeout(idleTimeout);
//     idleTimeout = setTimeout(logoutUser, 1800000); // 30 minutes in milliseconds
// }

// function logoutUser() {
//     // Redirect or perform logout action
//     window.location.href = '/logout';
// }

// document.addEventListener('mousemove', resetIdleTimeout);
// document.addEventListener('keypress', resetIdleTimeout);

// resetIdleTimeout();

$(document).ready(function() {

    var baseurl=window.location.protocol + "//" + window.location.host + "/";

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

	$(".select2").select2();

	$('form').parsley();

	function ifValid(data) {
		if(data) {
            $('#addUserBtn').attr('disabled', 'disabled');
			$('#updateFormBtn').attr('disabled', 'disabled');
		} else {
            $('#addUserBtn').removeAttr('disabled');
            $('#updateFormBtn').removeAttr('disabled');
		}
	};

	function checkusername(username) {
        $.ajax({
            type: 'POST',
            url: baseurl + 'checkusername',
            data: {'username':username},
            success: function(data) {
                if(data) {
                    $('.usernamecheck').html('<i class="mdi mdi-close-circle text-danger" aria-hidden="true" data-toggle="tooltip" data-placement="right" data-original-title="Username has been taken"> <small>Username has been taken</small></i>');
                    $('#username').removeClass('validuser');
                    ifValid(data);
                } else {
                    $('.usernamecheck').html('<i class="mdi mdi-checkbox-marked-circle text-success" aria-hidden="true" data-toggle="tooltip" data-placement="right" data-original-title="Username is available"> <small>Username is available</small></i>');
                    $('#username').addClass('validuser');
                    ifValid();
                }
            }
        })
	};

	function checkemail(email) {
        $.ajax({
            type: 'POST',
            url: baseurl + 'checkemail',
            data: {'email':email},
            success: function(data) {
                if(data) {
                    $('.emailcheck').html('<i class="mdi mdi-close-circle text-danger" aria-hidden="true" data-toggle="tooltip" data-placement="right" data-original-title="Email has been taken"> <small>Email has been taken</small></i>');
                    $('#email').removeClass('validuser');
                    ifValid(data);
                } else {
                    $('.emailcheck').html('<i class="mdi mdi-checkbox-marked-circle text-success" aria-hidden="true" data-toggle="tooltip" data-placement="right" data-original-title="Email is available"> <small>Email is available</small></i>');
                    $('#email').addClass('validuser');
                    ifValid();
                }
            }
        })
	};
	
	$('#username').on('blur keyup change', function() {
        var username = $(this).val();
        checkusername(username);
	});

	$('#email').on('blur keyup change', function() {
        var email = $(this).val();
        checkemail(email);
	});

	$('#wCountry').on('change', function() {
		var selectedVal = $(this).val();
		if(selectedVal) {
			$.ajax({
				url: document.location.origin + "/getStates",
				type: "GET",
				data: {selectedVal:selectedVal},
				success: function(response) {
					$('#wState').empty();
					$('#wState').removeAttr('disabled');
					$.each(response, function(key, value) {
						$('#wState').append('<option value="'+key+'">'+value+'</option>');
					});
				},
				error: function(xhr, status, error) {
					console.log(xhr.responseText);
				}
			});
		} else {
			$('#wState').empty();
		}
	});
	
    $('.btn-delete').on('click', function(e) {
		e.preventDefault();

		swal({
			title: 'Are you sure?',
			text: 'You will not be able to recover this information!',
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes!'
		}).then((result) => {
			if(result.value) {
				var id = $(e.currentTarget).attr('id');
				var module = $(e.currentTarget).attr('data-module');
				var name = $(e.currentTarget).attr('data-name');
				var datatable = "table";

				if(module == 'user') {
					var url = document.location.origin + "/admin/user/delete/" + id;
				} else if(module == 'title') {
					var url = document.location.origin + "/admin/validator/title/delete/" + id;
				} else if(module == 'industry') {
					var url = document.location.origin + "/admin/validator/industry/delete/" + id;
				} else if(module == 'state') {
					var url = document.location.origin + "/admin/validator/state/delete/" + id;
				} else if(module == 'country') {
					var url = document.location.origin + "/admin/validator/country/delete/" + id;
				} else if(module == 'freelancer') {
					var url = document.location.origin + "/freelance/delete/" + id;
				} else if(module == 'company') {
					var url = document.location.origin + "/company/delete/" + id;
				} else if(module == 'caller') {
					var url = document.location.origin + "/caller/delete/" + id;
				} else if(module == 'category') {
					var url = document.location.origin + "/admin/validator/category/delete/" + id;
				} else if(module == 'tag') {
					var url = document.location.origin + "/admin/validator/tag/delete/" + id;
				} else if(module == 'role') {
					var url = document.location.origin + "/admin/role/delete/" + id;
				} else if(module == 'lead') {
					var url = document.location.origin + "/lead/delete/" + id;
				}

				var data = "id="+id;
				$.ajax({
					type: "DELETE",
					url: url,
					data: data,
					success: function(data) {
						console.log(data);
						if(data) {
							$('.' + datatable).DataTable().row($(e.currentTarget).parents('tr')).remove().draw(false);
							swal('Deleted!', name + ' has been deleted', 'success');
						}
					}
				});
			}
		});
	});

});