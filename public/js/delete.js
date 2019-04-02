$(document).on('click', '.anchor_delete', function(e) {
    e.preventDefault();
    var $this = $(this);
    var from = $this.data('from');
    swal({
        title: 'Are you sure?',
        text: 'You want to delete this '+from+'?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.value) {
            $.ajax({
                type: $this.data('method'),
                url: $this.data('href'),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(result) {
                    if (result == 'success'){
                        location.reload();
                    }
                }
            });
        } else if (
            result.dismiss === swal.DismissReason.cancel
          ) {
            const toast = swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
              });

            toast({
                type: 'error',
                title: 'Cancelled. Your data is safe.'
            })
          }
      })  
});

$(document).on('click', '.perma_delete', function(e) {
    e.preventDefault();
    var $this = $(this);
    var from = $this.data('from');
    swal({
        title: 'Are you sure?',
        text: 'You won\'t be able to revert this!',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.value) {
            $.ajax({
                type: $this.data('method'),
                url: $this.data('href'),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(result) {
                    if (result == 'success'){
                        location.reload();
                    }
                }
            });
        } else if (
            result.dismiss === swal.DismissReason.cancel
          ) {
            const toast = swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
              });

            toast({
                type: 'error',
                title: 'Cancelled. Your data is safe.'
            })
          }
      })   
});

$(document).on('click', '.restore', function(e) {
    e.preventDefault();
    var $this = $(this);
    var from = $this.data('from');
    swal({
        title: 'Are you sure?',
        text: 'You want to restore this '+from+'?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, restore it!'
      }).then((result) => {
        if (result.value) {
            $.ajax({
                type: $this.data('method'),
                url: $this.data('href'),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(result) {
                    if (result == 'success'){
                        location.reload();
                    }
                }
            });
        } else if (
            result.dismiss === swal.DismissReason.cancel
          ) {
            const toast = swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
              });

            toast({
                type: 'error',
                title: 'Cancelled.'
            })
          }
      })   
});

$(document).on('click', '.deactivate', function(e) {
    e.preventDefault();
    var $this = $(this);
    var from = $this.data('from');
    var action = $this.data('action');
    swal({
        title: 'Are you sure?',
        text: 'You want to '+action+' this '+from+'?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, '+action+' it!'
      }).then((result) => {
        if (result.value) {
            $.ajax({
                type: $this.data('method'),
                url: $this.data('href'),
                data: {status: $this.data('value')},
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(result) {
                    if (result == 'success'){
                        location.reload();
                    }
                }
            });
        } else if (
            result.dismiss === swal.DismissReason.cancel
          ) {
            const toast = swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
              });

            toast({
                type: 'error',
                title: 'Cancelled. Your data is safe.'
            })
          }
      })   
});

$(document).on('click', '.remove_avatar', function(e) {
    e.preventDefault();
    var $this = $(this);
    swal({
        title: 'Are you sure?',
        text: 'You want to remove this avatar?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes!'
      }).then((result) => {
        if (result.value) {
            $.ajax({
                type: $this.data('method'),
                url: $this.data('href'),
                data: {user_id: $this.data('value')},
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(result) {
                    if (result == 'success'){
                        location.reload();
                    }
                }
            });
        } else if (
            result.dismiss === swal.DismissReason.cancel
          ) {
            const toast = swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
              });

            toast({
                type: 'error',
                title: 'Cancelled'
            })
          }
      })   
});

$(document).on('click', '.unread', function(e) {
    e.preventDefault();
    var $this = $(this);
    var url = "{{ route('markAsRead') }}";
    var convo_id = $this.data('convo');
    $.ajax({
        type: 'GET',
        url:  $this.data('href'),
        data: {id: $this.data('value')},
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(result) {
            if (result == 'success'){
                console.log(result);
                window.location.href = "/messages/convo/"+convo_id;
            }
        }
    });
   
});