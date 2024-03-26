function confirmDelete(id) {
    if (window.confirm("Are you sure you want to delete this service?")) {
        window.location.href = 'delete_services.php?deleteid=' + id;
    }
}