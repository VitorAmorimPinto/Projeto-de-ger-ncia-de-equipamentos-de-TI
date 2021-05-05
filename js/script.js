$("#selectTipoEquip").on("change", function(){
    let imgName = $("#selectTipoEquip option:selected").val();
    changeImg(imgName)
  })

  function changeImg(imgName) {
    $("#img-card").attr('src', `img/${imgName}.jpg`)
  }