function delete_ad(id){
    var deleted=confirm("Are you sure you want to delete this record ?")
    if(deleted==true){
        window.location.href="delete.php?id="+id
    }else{
        return false
    }
}
