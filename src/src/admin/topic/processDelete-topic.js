function deleteTopic(id){
    var option = confirm('Do you want to delete this Topic?')	
    if (!option){
        return;
    }
    if (option) {
        var option_2 = confirm('This action will delete all News of this topic, do you still want to continue?')
        if (!option_2) {
            return;
        }
    }
    console.log(id)
    //ajax - xu ly lenh post
    $.post('topic/processDelete-topic.php',{
        'id':id,
        'action': 'delete'
    },function(data){
        location.reload()
    })
}