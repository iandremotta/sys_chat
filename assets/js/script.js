function addGroupModal(){
    var html = '<h1>Criar nova sala</h1>';
    html += '<input type="text" id="newGroupName" placeholder="Digite o nome da nova sala">';
    html+='<br> <input type="button" id="newGroupButton" value="Cadastrar" >';
    html+='<hr><br><button onclick="fecharJanela()">Fechar Janela </button>';
    $('.modal_area').html(html);
    $('.modal_bg').show();
    $('#newGroupButton').on('click', function(){
        var newGroupName = $('#newGroupName').val();
        if(newGroupName !=''){
            chat.addNewGroup(newGroupName, (json)=>{
                if(json.error =='0'){
                    $('.add_tab').click();
                } else{
                    alert(json.errorMsg);
                }
            });
        }
    });
}

function fecharJanela(){
    return $('.modal_bg').hide();
}

$(function(){

    chat.chatActivity();
    
    $('.add_tab').click(()=>{
        var html = '<h1 style="background-color: #c8c8c8";font-size: 22px;>Novo grupo</h1>';
        html += '<div id="groupList">Carregando </div>'
        html+= '<hr><button onclick="addGroupModal()" style="background-color: #c8c8c8">Adicionar Grupo</button><button onclick="fecharJanela()" style="background-color: #c8c8c8">Fechar Janela</button><br><br>';
        $('.modal_area').html(html);
        $('.modal_bg').show();
        
        chat.loadGroupList((json)=>{
            var html = '';
            for(var i in json.list){
                html += '<button data-id="'+json.list[i].id+'">'+json.list[i].name +'</button>';
            }
            $('#groupList').html(html);
            $('#groupList').find('button').on('click', function(){
                var cid = $(this).attr('data-id');
                var cnm = $(this).text();

                chat.setGroup(cid, cnm);
                $('.modal_bg').hide();
            });
        });
    });

    $('nav ul').on('click', 'li .group_name', function(){
		var id = $(this).parent().attr('data-id');
		chat.setActiveGroup(id);
    });
    
    $('nav ul').on('click', 'li .group_close', function(){
		var id = $(this).parent().attr('data-id');
		chat.removeGroup(id);
	});

    $('#sender_input').on('keyup', function(e){
		if(e.keyCode == 13) {
			var msg = $(this).val();
			$(this).val('');

            chat.sendMessage(msg);
		}
    });
    
    $('.uploadFilesBtn').on('click', function(){
        $('#sender_input_file').trigger('click');
    });

    $('#sender_input_file').on('change', function(e){
        chat.sendFile(e.target.files[0]);
    });
});


