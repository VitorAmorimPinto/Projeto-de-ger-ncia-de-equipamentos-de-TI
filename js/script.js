$("#selectTipoEquip").on("change", function(){
    let imgName = $("#selectTipoEquip option:selected").val();
    changeImg(imgName)
  })

  function changeImg(imgName) {
    $("#img-card").attr('src', `img/${imgName}.jpg`)
  }

$(function(){
  
  $("#buscar").click(function(){
		//Recuperar o valor do campo
		var pesquisa = $('input[name="pesquisar"]').val();
    var tipo = $('select[name=tipo]').val();
		
		//Verificar se há algo digitado
		if(pesquisa != ''){
			var dados = {
				palavra : pesquisa,
        parametro : tipo
			}
			$.post('carrega.php', dados, function(retorna){
				//Mostra dentro da ul os resultado obtidos 
        var teste = JSON.parse(retorna);
        if(teste){
          $("#nomeRequerente").val(teste.nome);
          $("#emailRequerente").val(teste.email);

        }
			});
		}
	});

});