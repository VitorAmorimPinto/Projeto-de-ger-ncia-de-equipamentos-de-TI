var IdRequerente;
var list = new Array();
$("#selectTipoEquip").on("change", function(){
    let imgName = $("#selectTipoEquip option:selected").val();
    changeImg(imgName)
  })

  function changeImg(imgName) {
    $("#img-card").attr('src', `img/${imgName}.jpg`)
  }


// Função que trás os usuários
$(function(){
  
  $("#buscar").click(function(){
		//Recuperar o valor do campo
		var pesquisa = $('input[name="pesquisar"]').val();
    	var tipo = $('select[name=tipo]').val();
		//Verificar se há algo digitado
		if(pesquisa != ''){
			var dados = {
				palavra : pesquisa,
        		parametro : tipo,
				act : 'BuscUser'
			}
			$.post('buscaEmprestimo.php', dados, function(retorna){
		
			//Mostra dentro da ul os resultado obtidos 
			console.log(retorna);
		if(retorna){
			var teste = JSON.parse(retorna);
			if (teste.estado == "sim") {
				IdRequerente = teste.id;
				console.log(teste);
				$("#nomeRequerente").val(teste.nome);
				$("#emailRequerente").val(teste.email);
			}else if (teste.estado == "nao") {
				swal({

					title: teste.title,
					icon: teste.icon,
				});
				IdRequerente = null;
				$("#nomeRequerente").val("");
				$("#emailRequerente").val("");
			}
		}
        
         

        
			});
		}
	});

});
// Função que trás produtos disponíveis
$(function(){
  
  $(".teste").click(function(){
		//Recuperar o valor do campo
		var id = $(this).attr('data-id');
    	var tipo = $(this).attr('data-tipo');
		
    $('input[name="tipoEquip"]').val(tipo);

    
		
			var dados = {
				idProduto: id,
				act : 'BuscProd'
			}
      
			$.post('buscaEmprestimo.php', dados, function(retorna){
				//Mostra dentro da ul os resultado obtidos 
				console.log(retorna);
        	$(".patrimonio").html(retorna);
        
			});
	});

});

// Função de cadastrar Empréstimo

$(function(){
	$("#CadEmprestimo").click(function(){
	  //Recuperar o valor do campo
	  var tipoRequerimento = $('select[name=tipoRequerimento]').val();
	  var teste;	
	  switch (tipoRequerimento) {
		  	case 'Emprestimo':
			 	 var dados = {
					IdRequerente : IdRequerente,
					act : "CadEmprestimo"
				}

				$.post('buscaEmprestimo.php', dados, function(retorna){

				});
				list.forEach(equipamento);
				exibirMsgEmprestimo();	
				function equipamento(item) {

					var equipamento ={
					idEquipamento : item.idEquipamento,
					act : "registrarProdutoEmprestimo"
					}
					$.post('buscaEmprestimo.php', equipamento, function(teste){});
				}
				
			  break;
		  	case 'Reserva':
				var teste = {
					IdR : IdRequerente,
					act : "CadReserva"
				}

				$.post('buscaEmprestimo.php', teste, function(retorna){
				});
				list.forEach(equip);
				exibirMsgReserva();	

				function equip(item) {

					var equipamento ={
					idEquipamento : item.idEquipamento,
					act : "registrarProdutoReserva"
					}
					$.post('buscaEmprestimo.php', equipamento, function(retorna){
					});
				}
			  break;
	  
			default:
				console.log("default");
				break;
	  	}
	  
	});
  
  });
async function exibirMsgReserva() {
	await swal({
			title: "Reserva Cadastrado com Sucesso",
			icon: "success",
		})
		location.reload()
}
async function exibirMsgEmprestimo() {
	await swal({
			title: "Empréstimo Cadastrado com Sucesso",
			icon: "success",
		})
		location.reload()
}
  $(function(){
  
	$("#CadRequerente").click(function(){
	  //Recuperar o valor do campo
		var nome = $('input[name="CadnomeRequerente"]').val();
		var email = $('input[name="CadEmailRequerente"]').val();
		var cpf = $('input[name="CadCpf"]').val();
		var ra = $('input[name="CadRa"]').val();
		var TipoRequerente = $('select[name="TipoRequerente"]').val();
		var telefone = $('input[name="Telefone"]').val();
	  //Verificar se há algo digitado
		  
			  var dados = {
				nome : nome,
				email : email,
				cpf : cpf,
				ra : ra,
				TipoRequerente : TipoRequerente,
				telefone : telefone,
				act : 'CadRequerente'
			  }

			  
		
			  $.post('buscaEmprestimo.php', dados, function(retorna){
				  //Mostra dentro da ul os resultado obtidos 
				 	console.log(retorna); 
				  var itens = JSON.parse(retorna);
					swal({
						title: itens.title,
						icon: itens.icon,
					});

		  
			  });
	  });
  
  });
  $(function(){
  
    $("#addCarrinho").click(function(){
      //Recuperar o valor do campo
      var idEquipamento = $('select[name=patrimonio]').val();
      var tipo = $('input[name=tipoEquip]').val();
      

      //Verificar se há algo digitado
        
          var dados = {
              idEquipamento : idEquipamento,
              tipo : tipo
          }

          list.push(dados);
          swal({
				title: 'Item adicionado ao Carrinho',
				icon: 'success',
			});
          
          
          
      });
    
    });
    $(function(){
  
      $("#carrinho").click(function(){
        
        var i = 0;
        list.forEach(myFunction);
        function myFunction(item) {
          $("#Equipamentos").append('<tr>'+'<td>'+ item.tipo +'</td>'+'<td>'+item.idEquipamento+'</td>'+'<td>'+'<a  href="" value='+ i +' class="text-danger"><i class="fas fa-times-circle"></i></a>'+'</td>' +'</tr>');
          i++;
        }   

        });
      
      });
      $(function(){
  
        $("#close").click(function(){
          
          $("tr").remove();
          $("td").remove(); 
          
  
          });
        
        });
        // Remover itens da lista
        $(function(){
  
          $(".lala").click(function(){
            alert("cheguei")
            var teste = $('button[class=lala]').val();
              console.log(teste);
            
            });
          
          });
  
    