function formatar_cpf(v){
  if(v.value.length <= 14){
    v.value=v.value.replace(/\D/g,"")                    //Remove tudo o que não é dígito
    v.value=v.value.replace(/(\d{3})(\d)/,"$1.$2")       //Coloca um ponto entre o terceiro e o quarto dígitos
    v.value=v.value.replace(/(\d{3})(\d)/,"$1.$2")       //Coloca um ponto entre o terceiro e o quarto dígitos
    v.value=v.value.replace(/(\d{3})(\d{1,2})$/,"$1-$2") //Coloca um hífen entre o terceiro e o quarto dígitos
     
    return v
  }
}