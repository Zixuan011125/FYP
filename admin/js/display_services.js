function deleteSubService(id){
    if(confirm('Are you sure you want to delete this sub-services?')){
        window.location.href = 'delete_sub_services.php?id=' + id;
    }
}