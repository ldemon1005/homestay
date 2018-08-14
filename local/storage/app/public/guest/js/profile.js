function seeDetailModal(id)
{
    $.ajax({
        url : "/user/seeDetailModal",
        type : "get",
        success : function (result){
            $('#detailModal .modal-body').html(result);
            $('#detailModal').modal('show');
        }
    });
}