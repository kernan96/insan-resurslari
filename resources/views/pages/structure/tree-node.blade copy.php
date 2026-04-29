<script>if (data.success) {
    Swal.fire({
        icon: 'success',
        title: 'Uğurlu',
        text: data.message
    });
    form.reset();
    let modal = bootstrap.Modal.getInstance(document.getElementById('newOrgModal'));
    modal.hide();
}</script>