 function mascara_cpf(value) {
    const cnpjCpf = value.replace(/\D/g, '');
  
  if (cnpjCpf.length === 15) {
    return cnpjCpf.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/g, "\$1.\$2.\$3-\$4");
  } 
  
  return cnpjCpf.replace(/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/g, "\$1.\$2.\$3/\$4-\$5");

 }
 