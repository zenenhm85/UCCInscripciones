
/*----------------------------Página Inicio------------------*/
var paginainicio= new Vue({
  el:"#paginainicio",
  data:{
    lista:[],
    lista2:[],
    insc:'',
    paga:'',
    dinheirototal:'',
    feminino:'',
    masculino:'',
    listaQuantProv:[],
    listaQuantCursos:[],
    listaQuantProcedencia:[],
    listaQuantEnsinoMedio:[],
    porfemenino:'',
    pormasculino:'',
    sim:'',
    nao:'',
    porsim:'',
    pornao:'',
    aprovados:'',
    reprovados:'',
    aprovadosII:'',
    reprovadosII:'',
    poraprovados:'',
    porreprovados:'',
    poraprovadosII:'',
    porreprovadosII:'',
    listaQuantProcedenciaProm:[],
    listaQuantProcedenciaPromII:[]        
  },
  methods:{
    quantidadeInsc:async function(){
      var url = "./controlador/relatorios.php";
      axios.post(url, {opcao:1}).then(response =>{
         this.lista = response.data;                   
      });
    },
    quantidadePagamentos:async function(){
      var url = "./controlador/relatorios.php";
      axios.post(url, {opcao:-1}).then(response =>{
         this.lista2 = response.data;                   
      });
    },
    quantidadePagamentosInsc:async function(){
      var url = "./controlador/relatorios.php";
      axios.post(url, {opcao:2}).then(response =>{
         this.insc = response.data.quantinsc;   
         this.paga = response.data.quantpaga;                   
      });
    },
    dinheiroTotal:async function(){
      var url = "./controlador/relatorios.php";
      axios.post(url, {opcao:3}).then(response =>{
         this.dinheirototal = response.data;   
                           
      });
    },
    Sexo:async function(){
      var url = "./controlador/relatorios.php";
      axios.post(url, {opcao:4}).then(response =>{
         this.feminino = response.data.femenino; 
         this.masculino = response.data.masculino;  
         this.porfemenino = response.data.porfemenino;
         this.pormasculino = response.data.pormasculino;        
                           
      });
    },    
    inscricaoporProvincias:async function(){
      var url = "./controlador/relatorios.php";
      axios.post(url, {opcao:5}).then(response =>{
         this.listaQuantProv = response.data;           
                           
      });
    },
    inscricaoporCursos:async function(){
      var url = "./controlador/relatorios.php";
      axios.post(url, {opcao:6}).then(response =>{
         this.listaQuantCursos = response.data;           
                           
      });
    },
    procedencia:async function(){
      var url = "./controlador/relatorios.php";
      axios.post(url, {opcao:10}).then(response =>{
         this.listaQuantProcedencia = response.data;           
                           
      });
    },
    ensinomedio:async function(){
      var url = "./controlador/relatorios.php";
      axios.post(url, {opcao:11}).then(response =>{
         this.listaQuantEnsinoMedio = response.data;           
                           
      });
    },
    tabalhador:async function(){
      var url = "./controlador/relatorios.php";
      axios.post(url, {opcao:12}).then(response =>{
         this.sim = response.data.sim; 
         this.nao = response.data.nao;  
         this.porsim = response.data.porsim;
         this.pornao = response.data.pornao;        
                           
      });
    },
    resultadosI:async function(){
      var url = "./controlador/relatorios.php";
      axios.post(url, {opcao:13}).then(response =>{
         this.aprovados = response.data.aprovados; 
         this.reprovados = response.data.reprovados;  
         this.poraprovados = response.data.poraprovados;
         this.porreprovados = response.data.porreprovados;        
                           
      });
    },
    resultadosII:async function(){
      var url = "./controlador/relatorios.php";
      axios.post(url, {opcao:15}).then(response =>{
         this.aprovadosII = response.data.aprovados; 
         this.reprovadosII = response.data.reprovados;  
         this.poraprovadosII = response.data.poraprovados;
         this.porreprovadosII = response.data.porreprovados;        
                           
      });
    },
    procedenciaPromedio:async function(){
      var url = "./controlador/relatorios.php";
      axios.post(url, {opcao:14}).then(response =>{
         this.listaQuantProcedenciaProm = response.data;           
                           
      });
    },
    procedenciaPromedioII:async function(){
      var url = "./controlador/relatorios.php";
      axios.post(url, {opcao:16}).then(response =>{
         this.listaQuantProcedenciaPromII = response.data;           
                           
      });
    }

  },
  created: function(){
      
      this.quantidadePagamentosInsc();
      this.dinheiroTotal();
      this.Sexo();
      this.inscricaoporProvincias();
      this.inscricaoporCursos();
      this.procedencia();
      this.ensinomedio();
      this.tabalhador();
      this.resultadosI();
      this.procedenciaPromedio();
      this.resultadosII();
      this.procedenciaPromedioII();

   }
});

/*----------------------------Inicio de Sessao------------------*/
var iniciosesao = new Vue({
  el:"#users",
  data:{
    
  },
  methods:{
    Entrar:async function(){
      var userid = document.getElementById('idnome').value;
      var senha = document.getElementById('passwordinicio').value;

      if(userid == '' || senha == ''){
        Swal.fire({
          type: 'error',
          title: 'Dados incompletos.',                        
        }) 
      } 
      else{
        var url = "./controlador/usuario.php";
        axios.post(url, {opcao:1,userid:userid,senha:senha}).then(response =>{
          var aux = response.data;
          if(aux == "1"){
            document.getElementById('idnome').value = '';
            document.getElementById('passwordinicio').value = '';   

            const Toast = Swal.mixin({
              toast: true,
              position: 'top-end',
              showConfirmButton: false,
              timer: 5000
            });
            Toast.fire({
              type: 'success',
              title: 'Sessão iniciada com sucesso!'
            });
            location.href="./inicio.php";  
          }
          else if(aux == "0"){
            Swal.fire({
              type: 'error',
              title: 'Usuário não válido',                        
            }) 
          }
          else if(aux == "2"){
            Swal.fire({
              type: 'error',
              title: 'Usuário Desabilitado',                        
            }) 
          }
          else if(aux == "3"){
            Swal.fire({
              type: 'error',
              title: 'Senha Incorreta',                        
            }) 
          }
          else{
            Swal.fire({
              type: 'error',
              title: ''+aux,                        
            }) 

          }
          
      });                   


      }    

    }    
  } 
});
/*----------------------------Usuários------------------*/
var usuarios = new Vue({
  el:"#usuarios",
  data:{
    usuarios:[],
    nome:'',
    iduser:'', 
    email:'',
    telefone:'',
    tipo:'',
    habilitado:''       
  },
  methods:{
    listarUsers: async function(){
        var url = "./controlador/usuario.php";
        axios.post(url, {opcao:4}).then(response =>{
           this.usuarios = response.data;       
        });
    },
    Info:function(nome,iduser,email,telefone,tipo,habilitado){
      this.nome = nome;
      this.iduser = iduser;
      this.email = email;
      this.telefone = telefone;
      if(tipo == "1"){
        this.tipo = "Administrador";
      }
      else if(tipo == "2"){
        this.tipo = "Operador 1";
      }
      else{
        this.tipo = "Operador 2";
      }
      if(habilitado == "1"){
        this.habilitado = "Sim";
      }
      else{
        this.habilitado = "Não";
      }

    },
    btnInserir: async function(){            
          nomeuser = document.getElementById('nomeuser').value;
          email = document.getElementById('email').value;
          telefone = document.getElementById('telefone').value;
          iduser = document.getElementById('iduser').value;
          senhauser = document.getElementById('senhauser').value;
          repsenhauser = document.getElementById('repsenhauser').value;
          tipouser = document.getElementById('tipouser').value;
          if(nomeuser == "" || iduser == "" || tipouser < 0 || senhauser == "" || email=="" || telefone == ""){
              Swal.fire({
                type: 'error',
                title: 'Dados incompletos.',                        
              }) 
            } 
            else if(senhauser != repsenhauser){
                Swal.fire({
                    type: 'error',
                    title: 'As senhas devem ser iguais.',                        
                  }) 
            }  
            else if(senhauser.length < 6){
                Swal.fire({
                    type: 'error',
                    title: 'A senha deve ter mais de 5 caracteres',                        
                  }) 
            }      
            else{          
                var url = "./controlador/usuario.php";
                axios.post(url, {opcao:3,nome:nomeuser,email:email,telefone:telefone,idusuario:iduser,senha:senhauser,tipo:tipouser}).then(response =>{
                    var aux = response.data;
                    if(aux == "1"){
                      this.listarUsers();
                      document.getElementById('nomeuser').value='';
                      document.getElementById('email').value='';
                      document.getElementById('telefone').value='';
                      document.getElementById('iduser').value='';
                      document.getElementById('senhauser').value='';
                      document.getElementById('repsenhauser').value='';
                      document.getElementById('tipouser').value='1';                      
                      const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 5000
                      });
                      Toast.fire({
                        type: 'success',
                        title: 'Usuário inserido com sucesso!'
                      });
                      $('#inseriruserModal').modal('hide');  
                    }
                    else{
                      Swal.fire({
                        type: 'error',
                        title: ''+aux,                        
                      }) 

                    }
                    
                });                   
            }
        },
    habilitarUser: async function(iduser,habilitadouser){
          var url = "./controlador/usuario.php";
          axios.post(url, {opcao:2,id:iduser, habilitado:habilitadouser}).then(response =>{
              var aux = response.data;
              if(aux == "1"){
                this.listarUsers();                              
                const Toast = Swal.mixin({
                  toast: true,
                  position: 'top-end',
                  showConfirmButton: false,
                  timer: 5000
                });
                Toast.fire({
                  type: 'success',
                  title: 'Mudança realizada com sucesso!'
                });                 
              }
              else{
                Swal.fire({
                  type: 'error',
                  title: ''+aux,                        
                }) 

              }              
          });            
          
        },
    Eliminar:function(iduser){
      this.iduser = iduser;
    },
    btnEliminar:async function(){
        var url = "./controlador/usuario.php";
        axios.post(url, {opcao:5,idusuario:this.iduser}).then(response =>{
            var aux = response.data;
            if(aux == "1"){                               
              const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 5000
              });
              Toast.fire({
                type: 'success',
                title: 'Usuário eliminado com sucesso!'
              });
              $('#excluiruserModal').modal('hide'); 
              this.listarUsers(); 
            }
            else if(aux == "2"){
              const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 5000
              });
              Toast.fire({
                type: 'success',
                title: 'Usuário eliminado com sucesso!'
              });
              $('#excluiruserModal').modal('hide');
               location.href="./index.php"; 
            }
            else{
              Swal.fire({
                type: 'error',
                title: ''+aux,                        
              }) 

            }
            
        });            

    },
    Alterar:function(nome,idusuario,telefone,email,tipo){
      this.iduser = idusuario;
      document.getElementById('nomeusera').value = nome;
      document.getElementById('idusera').value = idusuario;
      document.getElementById('emaila').value = email;
      document.getElementById('telefonea').value = telefone;
      document.getElementById('tipousera').value = tipo;
    },
    btnAlterar: async function(){
      var useranterior = this.iduser;
      var iduser = document.getElementById('idusera').value;
      var nome = document.getElementById('nomeusera').value;
      var email = document.getElementById('emaila').value;
      var telefone = document.getElementById('telefonea').value;
      var tipo = document.getElementById('tipousera').value;
      var senha = document.getElementById('senhausera').value;

      if(nome == "" || iduser == "" || tipouser < 0 || email =="" || telefone == "" ){
        Swal.fire({
          type: 'error',
          title: 'Dados incompletos.',                        
        }) 
      } 
      else if(senha.length > 0 && senha.length < 6){
        Swal.fire({
          type: 'error',
          title: 'A senha têm que ter 6 caracteres como mínimo',                        
        }) 
      }            
      else{          
          var url = "./controlador/usuario.php";
          axios.post(url, {opcao:7,ida:useranterior,iduser:iduser,nome:nome,tipo:tipo, email:email,telefone:telefone,senha:senha}).then(response =>{
              var aux = response.data;
              if(aux == "1"){
                this.listarUsers();                      
                const Toast = Swal.mixin({
                  toast: true,
                  position: 'top-end',
                  showConfirmButton: false,
                  timer: 5000
                });
                Toast.fire({
                  type: 'success',
                  title: 'Usuário alterado com sucesso!'
                });
                $('#alteraruserModal').modal('hide');  
              }
              else{
                Swal.fire({
                  type: 'error',
                  title: ''+aux,                        
                }) 

              }
              
          });                   
      }
    } 
  },
  created: function(){            
      this.listarUsers();            
   }

});
/*----------------------Sessao--------------------------------------------*/
var sessao = new Vue({
  el:"#sessao",
  data:{
           
  },
  methods:{
    FecharSessao:async function(){
      var url = "./controlador/fecharsessao.php";
      axios.post(url, {opcao:5}).then(response =>{
              var aux = response.data;
              if(aux=="1"){
                location.href="./index.php";  
              }
                          
          });            

    }

  }
});
/*----------------------Sessao2--------------------------------------------*/
var sessao2 = new Vue({
  el:"#sessao2",
  data:{
           
  },
  methods:{
    FecharSessao:async function(){
      var url = "./controlador/fecharsessao.php";
      axios.post(url, {opcao:5}).then(response =>{
              var aux = response.data;
              if(aux=="1"){
                location.href="./index.php";  
              }
                          
          });            

    }

  }
});
/*--------------------------Trocar Senha-----------------------------*/
var trocarsenha = new Vue({
  el:"#trocarsenha",
  data:{
           
  },
  methods:{
    TrocarSenha:async function(){
      var userid = document.getElementById('idusertrocar').value;
      var senhaa = document.getElementById('senhausertrocar').value;
      var senhan = document.getElementById('novasenhatrocar').value;
      var senhanr = document.getElementById('repnovasenhatrocar').value;
      if(senhaa == '' || senhan.length < 6 || senhan != senhanr){
        Swal.fire({
          type: 'error',
          title: 'Dados incompletos, senha nova menor a 6 caracteres ou distinta a sua correspondente repetição.',                        
        }) 
      } 
      else{
        var url = "./controlador/usuario.php";
          axios.post(url, {opcao:6,userid:userid,senhaa:senhaa, senhan: senhan}).then(response =>{
            var aux = response.data;
            if(aux == "1"){
              document.getElementById('senhausertrocar').value = '';
              document.getElementById('novasenhatrocar').value = ''; 
              document.getElementById('repnovasenhatrocar').value = '';                                           
              const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 5000
              });
              Toast.fire({
                type: 'success',
                title: 'Senha trocada com sucesso!'
              });       
            } 
            else if(aux == "0"){
              Swal.fire({
                type: 'error',
                title: 'Senha anterior não válida',                        
              }) 

            }        
            else if(aux == "2"){
              Swal.fire({
                type: 'error',
                title: "Usuário não válido",                        
              }) 

            }
            else{
              Swal.fire({
                type: 'error',
                title: aux,                        
              }) 
            }
            
        });
      }    

    }    

  }
});
/*----------------------BANCOS--------------------------------------------*/
var bancos = new Vue({
  el:"#bancos",
  data:{
    bancos:[],
    nome:'',
    descricao:''           
  },
  methods:{
     btnInserir: async function(){            
          nome = document.getElementById('nomebanco').value;
          descricao = document.getElementById('descricao').value; 

          if(nome == "" || descricao == ""){
              Swal.fire({
                type: 'error',
                title: 'Dados incompletos.',                        
              }) 
            } 
            else{          
                var url = "./controlador/bancos.php";
                axios.post(url, {opcao:1,nome:nome,descricao:descricao}).then(response =>{
                    var aux = response.data;
                    if(aux == "1"){
                      this.listarBancos();
                      document.getElementById('nomebanco').value='';
                      document.getElementById('descricao').value='';                                          
                      const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 5000
                      });
                      Toast.fire({
                        type: 'success',
                        title: 'Banco inserido com sucesso!'
                      });
                      $('#inserirbancoModal').modal('hide');  
                    }
                    else{
                      Swal.fire({
                        type: 'error',
                        title: ''+aux,                        
                      }) 

                    }                    
                });                   
            }
        },
    Eliminar:function(nomebanco){
      this.nome = nomebanco;
    },
    btnEliminar:async function(){
        var url = "./controlador/bancos.php";
        axios.post(url, {opcao:2,nome:this.nome}).then(response =>{
            var aux = response.data;
            if(aux == "1"){                               
              const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 5000
              });
              Toast.fire({
                type: 'success',
                title: 'Banco eliminado com sucesso!'
              });
              $('#excluibancoModal').modal('hide'); 
              this.listarBancos(); 
            }
            else{
              Swal.fire({
                type: 'error',
                title: ''+aux,                        
              }) 

            }
            
        });
    },
    Alterar:function(nome,descricao){
      this.nome = nome;
      document.getElementById('nomebancoa').value = nome;
      document.getElementById('descricaoa').value = descricao;
    },
    btnAlterar:async function(){
      var nome = document.getElementById('nomebancoa').value;
      var descricao = document.getElementById('descricaoa').value;
      if(nome == "" || descricao == ""){
        Swal.fire({
          type: 'error',
          title: 'Dados incompletos.',                        
        }) 
      } 
      else{          
          var url = "./controlador/bancos.php";
          axios.post(url, {opcao:3,nomea:this.nome,nome:nome,descricao:descricao}).then(response =>{
              var aux = response.data;
              if(aux == "1"){
                this.listarBancos();
                document.getElementById('nomebancoa').value='';
                document.getElementById('descricaoa').value='';                                          
                const Toast = Swal.mixin({
                  toast: true,
                  position: 'top-end',
                  showConfirmButton: false,
                  timer: 5000
                });
                Toast.fire({
                  type: 'success',
                  title: 'Banco alterado com sucesso!'
                });
                $('#alterarbancoModal').modal('hide');  
              }
              else{
                Swal.fire({
                  type: 'error',
                  title: ''+aux,                        
                }) 

              }                    
          });                   
      }
    },
    listarBancos: async function(){
        var url = "./controlador/bancos.php";
        axios.post(url, {opcao:4}).then(response =>{
           this.bancos = response.data;       
        });
    }
  },
  created: function(){            
      this.listarBancos();            
   }
});
/*----------------------CURSOS--------------------------------------------*/
var cursos = new Vue({
  el:"#cursos",
  data:{
    cursos:[],
    nome:''           
  },
  methods:{
     btnInserir: async function(){            
          nome = document.getElementById('nomecurso').value;

          if(nome == ""){
              Swal.fire({
                type: 'error',
                title: 'Dados incompletos.',                        
              }) 
            } 
            else{          
                var url = "./controlador/cursos.php";
                axios.post(url, {opcao:1,nome:nome}).then(response =>{
                    var aux = response.data;
                    if(aux == "1"){
                      this.listarCursos();
                      document.getElementById('nomecurso').value='';                                                              
                      const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 5000
                      });
                      Toast.fire({
                        type: 'success',
                        title: 'Curso inserido com sucesso!'
                      });
                      $('#inserircursoModal').modal('hide');  
                    }
                    else{
                      Swal.fire({
                        type: 'error',
                        title: ''+aux,                        
                      }) 

                    }                    
                });                   
            }
        },
    Eliminar:function(nomecurso){
      this.nome = nomecurso;
    },
    btnEliminar:async function(){
        var url = "./controlador/cursos.php";
        axios.post(url, {opcao:2,nome:this.nome}).then(response =>{
            var aux = response.data;
            if(aux == "1"){                               
              const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 5000
              });
              Toast.fire({
                type: 'success',
                title: 'Curso eliminado com sucesso!'
              });
              $('#excluicursoModal').modal('hide'); 
              this.listarCursos(); 
            }
            else{
              Swal.fire({
                type: 'error',
                title: ''+aux,                        
              }) 

            }
            
        });
    },
    Alterar:function(nome){
      this.nome = nome;
      document.getElementById('nomecursoa').value = nome;      
    },
    btnAlterar:async function(){
      var nome = document.getElementById('nomecursoa').value;      
      if(nome == ""){
        Swal.fire({
          type: 'error',
          title: 'Dados incompletos.',                        
        }) 
      } 
      else{          
          var url = "./controlador/cursos.php";
          axios.post(url, {opcao:3,nomea:this.nome,nome:nome}).then(response =>{
              var aux = response.data;
              if(aux == "1"){
                this.listarCursos();
                document.getElementById('nomecursoa').value='';                                                         
                const Toast = Swal.mixin({
                  toast: true,
                  position: 'top-end',
                  showConfirmButton: false,
                  timer: 5000
                });
                Toast.fire({
                  type: 'success',
                  title: 'Curso alterado com sucesso!'
                });
                $('#alterarcursoModal').modal('hide');  
              }
              else{
                Swal.fire({
                  type: 'error',
                  title: ''+aux,                        
                }) 

              }                    
          });                   
      }
    },
    listarCursos: async function(){
        var url = "./controlador/cursos.php";
        axios.post(url, {opcao:4}).then(response =>{
           this.cursos = response.data;       
        });
    }
  },
  created: function(){            
      this.listarCursos();            
   }
});
/* --------------------------- PROVINCIAS-------------------------------------------------*/
var provincia = new Vue({
  el:'#provincia',
  data:{
    provincias:[],
    nomeprovincia:''
  },
  methods:{
    btnInserirP:async function(){
      this.nomeprovincia = document.getElementById('nomeprovincia').value;

      if(this.nomeprovincia == "" ){
          Swal.fire({
            type: 'error',
            title: 'Dados incompletos.',                        
          }) 
        }         
        else{          
            var url = "./controlador/provincia.php";
            axios.post(url, {opcao:1,nome:this.nomeprovincia}).then(response =>{
                var aux = response.data;
                if(aux == "1"){
                  this.listarProvincias();
                  document.getElementById('nomeprovincia').value='';
                  this.nomeprovincia = '';                  
                  const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 5000
                  });
                  Toast.fire({
                    type: 'success',
                    title: 'Província inserida com sucesso!'
                  });
                  $('#inserirprovModal').modal('hide');  
                }
                else{
                  Swal.fire({
                    type: 'error',
                    title: ''+aux,                        
                  }) 

                }
                
            });                   
        }

    },
    btnAlterarP:function(nome){
      document.getElementById('nomeprovinciaa').value = nome;
      this.nomeprovincia = nome;
    },
    btnExcluirP:function(nome){
      this.nomeprovincia = nome;
    },    
    alterarP:async function(){
      var nomeatual = document.getElementById('nomeprovinciaa').value;
      if(nomeatual == ""){
          Swal.fire({
            type: 'error',
            title: 'Dados incompletos.',                        
          }) 
        }             
        else{          
            var url = "./controlador/provincia.php";
            axios.post(url, {opcao:2,nomea:this.nomeprovincia, nome:nomeatual}).then(response =>{
                var aux = response.data;
                if(aux == "1"){
                  this.listarProvincias();
                  this.nomeprovincia = '';                  
                  const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 5000
                  });
                  Toast.fire({
                    type: 'success',
                    title: 'Província alterada com sucesso!!'
                  });
                  $('#alterarprovModal').modal('hide');  
                }
                else{
                  Swal.fire({
                    type: 'error',
                    title: ''+aux,                        
                  }) 

                }
                
            });                   
        }
    },
    excluirP:async function(){
      var url = "./controlador/provincia.php";
      axios.post(url, {opcao:3,nome:this.nomeprovincia}).then(response =>{
          var aux = response.data;
          if(aux == "1"){
            this.listarProvincias();                      
            this.nomeprovincia = '';                      
            const Toast = Swal.mixin({
              toast: true,
              position: 'top-end',
              showConfirmButton: false,
              timer: 5000
            });
            Toast.fire({
              type: 'success',
              title: 'Província excluída com sucesso!'
            });
            $('#excluirprovModal').modal('hide');  
          }
          else{
            Swal.fire({
              type: 'error',
              title: ''+aux,                        
            }) 

          }              
      });      

    },
    listarProvincias:function(){
        var url = "./controlador/provincia.php";
        axios.post(url, {opcao:4}).then(response =>{
            this.provincias = response.data;       
        });
    }
  },
  created: function(){ 
    this.listarProvincias();            
  }
});
/* --------------------------- MUNICÍPIOS-------------------------------------------------*/
var municipio = new Vue({
  el:'#municipio',
  data:{
    municipios:[],
    municipiosProv:[],
    provincias:[],
    nomemunicipio:'',
    nomeprovincia:'',
    nomem:'',
    nomep:''
  },
  methods:{
      btnInserirM:async function(){
        this.nomemunicipio = document.getElementById('nomemunicipio').value;

        if(this.nomemunicipio == "" || this.nomeprovincia==""){
            Swal.fire({
              type: 'error',
              title: 'Dados incompletos.',                        
            }) 
          }         
          else{          
              var url = "./controlador/municipio.php";
              axios.post(url, {opcao:1,nomep:this.nomeprovincia, nomem:this.nomemunicipio}).then(response =>{
                  var aux = response.data;
                  if(aux == "1"){
                    this.listarMunicipiosProv(this.nomeprovincia);
                    document.getElementById('nomemunicipio').value='';
                    this.nomemunicipio;                  
                    const Toast = Swal.mixin({
                      toast: true,
                      position: 'top-end',
                      showConfirmButton: false,
                      timer: 5000
                    });
                    Toast.fire({
                      type: 'success',
                      title: 'Município inserido com sucesso!'
                    });
                    $('#inserimunicipioModal').modal('hide');  
                  }
                  else{
                    Swal.fire({
                      type: 'error',
                      title: ''+aux,                        
                    }) 

                  }
                  
              });                   
          }

      },
      btnAlterarM:function(nomep,nomem){
        this.nomem = nomem;
        this.nomep = nomep;
        document.getElementById('nomemunicipiom').value = nomem;
        document.getElementById('nomeprovinciamm').value = nomep;               
      },
      btnExcluirM:function(nomep,nomem){
        this.nomem = nomem;
        this.nomep = nomep;
      },    
      alterarM:async function(){
        var nomep = document.getElementById('nomeprovinciamm').value;
        var nomem = document.getElementById('nomemunicipiom').value;

        if(nomem == ""){
            Swal.fire({
              type: 'error',
              title: 'Dados incompletos.',                        
            }) 
          }             
          else{          
              var url = "./controlador/municipio.php";
              axios.post(url, {opcao:2,nomepa:this.nomep,nomema:this.nomem,nomep:nomep, nomem:nomem}).then(response =>{
                  var aux = response.data;
                  if(aux == "1"){
                    this.nomeprovincia = nomep;
                    this.listarMunicipiosProv(this.nomeprovincia);                                  
                    const Toast = Swal.mixin({
                      toast: true,
                      position: 'top-end',
                      showConfirmButton: false,
                      timer: 5000
                    });
                    Toast.fire({
                      type: 'success',
                      title: 'Município alterado com sucesso!!'
                    });
                    $('#alterarmunicipioModal').modal('hide');  
                  }
                  else{
                    Swal.fire({
                      type: 'error',
                      title: ''+aux,                        
                    }) 

                  }
                  
              });                   
          }
      },
      excluirM:async function(){
        var url = "./controlador/municipio.php";
        axios.post(url, {opcao:3,nomep:this.nomep,nomem:this.nomem}).then(response =>{
            var aux = response.data;
            if(aux == "1"){
              this.listarMunicipiosProv(this.nomeprovincia);                      
              this.id = '';                      
              const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 5000
              });
              Toast.fire({
                type: 'success',
                title: 'Município excluído com sucesso!'
              });
              $('#excluirmunicipioModal').modal('hide');  
            }
            else{
              Swal.fire({
                type: 'error',
                title: ''+aux,                        
              }) 

            }              
        });      

      },
      listarMunicipios:async function(){
          var url = "./controlador/municipio.php";
          axios.post(url, {opcao:4}).then(response =>{
              this.municipios = response.data;       
          });
      },
      listarMunicipiosProv:async function(provincia){
        var url = "./controlador/municipio.php";
        axios.post(url, {opcao:5,nomeprov:provincia}).then(response =>{
            this.municipiosProv = response.data;       
        });
    },
      listarProvincias:async function(){
        var url = "./controlador/provincia.php";
        axios.post(url, {opcao:4}).then(response =>{
            this.provincias = response.data;
            this.nomeprovincia = this.provincias[0].nome;
            var url2 = "./controlador/municipio.php";
            axios.post(url2, {opcao:5,nomeprov:this.provincias[0].nome}).then(response =>{
                this.municipiosProv = response.data;       
            });
        });
    }
  },  
  created: function(){ 
    this.listarProvincias();               
  },
  computed: {
      
  }
});
/* --------------------------- COMUNA-------------------------------------------------*/
var comuna = new Vue({
  el:'#comuna',
  data:{
    comunasporMunicipioseProv:[],  
    provincias:[],
    municipiosProv:[],
    municipiosProvM:[],
    nomeprovincia:'',
    nomemunicipio:'',
    nomeprovinciam:'',
    nomemunicipiom:'',
    nomecomuna:'',
    nomecomunae:'',
    nomemunicipioe:'',
    nomeprovinciae:''  
  },
  methods:{
      btnInserirC:async function(){
        nomep = document.getElementById('nomeprovinciac').value;
        nomem = document.getElementById('nomemunicipioc').value;
        nomec = document.getElementById('nomecomuna').value;

        if(nomep == "" || nomem == "" || nomec == ""){
            Swal.fire({
              type: 'error',
              title: 'Dados incompletos.',                        
            }) 
          }         
          else{          
              var url = "./controlador/comuna.php";
              axios.post(url, {opcao:1,nomep:nomep, nomem:nomem, nomec:nomec}).then(response =>{
                  var aux = response.data;
                  if(aux == "1"){
                    this.listarComunasPorMunicipioseProv(nomep,nomem);                    
                    document.getElementById('nomecomuna').value='';                                  
                    const Toast = Swal.mixin({
                      toast: true,
                      position: 'top-end',
                      showConfirmButton: false,
                      timer: 5000
                    });
                    Toast.fire({
                      type: 'success',
                      title: 'Comuna inserida com sucesso!'
                    });
                    $('#inserircomunaModal').modal('hide');  
                  }
                  else{
                    Swal.fire({
                      type: 'error',
                      title: ''+aux,                        
                    }) 

                  }
                  
              });                   
          }

      },
      btnAlterarC:function(nomec){        
        this.nomeprovinciam= this.nomeprovincia;
        this.nomecomuna = nomec;
        this.nomemunicipiom = this.nomemunicipio;       
        document.getElementById('nomecomunam').value = nomec;            
      },
      btnExcluirC:function(nomep,nomem,nomec){
        this.nomeprovinciae = nomep;
        this.nomemunicipioe = nomem;
        this.nomecomunae = nomec;
      },    
      alterarC:async function(){
        var nomep = this.nomeprovinciam;
        var nomem = this.nomemunicipiom;
        var nomec = document.getElementById('nomecomunam').value;

        if(nomep == "" || nomem == "" || nomec == ""){
            Swal.fire({
              type: 'error',
              title: 'Dados incompletos.',                        
            }) 
          }             
          else{          
              var url = "./controlador/comuna.php";
              axios.post(url, {opcao:2,nomepa:this.nomeprovincia,nomema:this.nomemunicipio,nomeca:this.nomecomuna,nomep:nomep,nomem:nomem,nomec:nomec}).then(response =>{
                  var aux = response.data;
                  if(aux == "1"){       

                    this.listarComunasPorMunicipioseProv(this.nomeprovincia,this.nomemunicipio);                               

                    const Toast = Swal.mixin({
                      toast: true,
                      position: 'top-end',
                      showConfirmButton: false,
                      timer: 5000
                    });
                    Toast.fire({
                      type: 'success',
                      title: 'Comuna alterada com sucesso!!'
                    });
                    $('#alterarcomunaModal').modal('hide');  
                  }
                  else{
                    Swal.fire({
                      type: 'error',
                      title: ''+aux,                        
                    }) 

                  }
                  
              });                   
          }
      },
      excluirC:async function(){
        var url = "./controlador/comuna.php";
        axios.post(url, {opcao:3,nomep:this.nomeprovinciae,nomem:this.nomemunicipioe,nomec:this.nomecomunae}).then(response =>{
            var aux = response.data;
            if(aux == "1"){
              this.listarComunasPorMunicipioseProv(this.nomeprovinciae,this.nomemunicipioe);      
                               
              const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 5000
              });
              Toast.fire({
                type: 'success',
                title: 'Comuna excluída com sucesso!'
              });
              $('#excluirComunaModal').modal('hide');  
            }
            else{
              Swal.fire({
                type: 'error',
                title: ''+aux,                        
              }) 

            }              
        });      

      },
      listarMunicipiosProv:async function(provincia){
        var url = "./controlador/municipio.php";
        axios.post(url, {opcao:5,nomeprov:provincia}).then(response =>{
            this.municipiosProv = response.data; 
            this.municipiosProvM = response.data;  
            this.nomemunicipio = this.municipiosProv[0].nomem; 
            this.nomemunicipiom = this.municipiosProv[0].nomem; 
            var url3 = "./controlador/comuna.php";
            axios.post(url3, {opcao:6,nomep:this.nomeprovincia,nomem:this.municipiosProv[0].nomem}).then(response =>{
              this.comunasporMunicipioseProv = response.data;                     
            });                       
        });
    },
    listarMunicipiosProvM:async function(provincia){
        var url = "./controlador/municipio.php";
        axios.post(url, {opcao:5,nomeprov:provincia}).then(response =>{
            this.municipiosProvM = response.data;    
            this.nomemunicipiom = this.municipiosProvM[0].nomem;                                         
        });
    },
      listarProvincias:async function(){
        var url = "./controlador/provincia.php";
        axios.post(url, {opcao:4}).then(response =>{
            this.provincias = response.data;
            this.nomeprovincia = this.provincias[0].nome;
            var url2 = "./controlador/municipio.php";
            axios.post(url2, {opcao:5,nomeprov:this.provincias[0].nome}).then(response =>{
                this.municipiosProv = response.data; 
                this.municipiosProvM = response.data;
                this.nomemunicipio = this.municipiosProv[0].nomem;
                this.nomemunicipiom = this.municipiosProvM[0].nomem;
                var url3 = "./controlador/comuna.php";
                axios.post(url3, {opcao:6,nomep:this.provincias[0].nome,nomem:this.municipiosProv[0].nomem}).then(response =>{
                  this.comunasporMunicipioseProv = response.data;                     
                });      
            });
        });
    },
    listarComunasPorMunicipioseProv:async function(nomep,nomem){
        var url = "./controlador/comuna.php";
        axios.post(url, {opcao:6,nomep:nomep,nomem:nomem}).then(response =>{
            this.comunasporMunicipioseProv = response.data; 
            this.nomeprovincia = nomep;
            this.nomemunicipio = nomem;                                           
        });
    }
  },  
  created: function(){ 
    this.listarProvincias();               
  },
  computed: {
      
  }
});
/* --------------------------- ALUNO-------------------------------------------------*/
var aluno = new Vue({
  el:'#alunos',
  data:{
    alunos:[],
    provincias:[],
    provinciasM:[],
    municipios:[],
    municipiosM:[],
    procedencias:[],
    cursosmedio:[],
    comunas:[],
    nomeprovincia:'',
    nomemunicipio:'',
    nomecomuna:'',
    nomeprovinciam:'',
    nomemunicipiom:'',
    nomecomunam:'',
    bi:'',
    indice:1,
    bii:'',
    datanasci:'',
    nomecompletoi:'',
    comunai:'',
    municipioi:'',
    provinciai:'',
    enderecoi:'',
    sexoi:'',
    telefonei:'',
    emaili:'',
    obsi:'',
    procedencia:'PUNIV',
    cursomedio:'',
    trabalhador:'', 
    procedenciai:'',
    cursomedioi:'',
    trabalhadori:'',
    procedenciam:'',
    cursomediom:'',
    trabalhadorm:'',
    procuraralunobi:'',
    useri:'',
    cci:'Sim',
    ccm:1   
  },
  methods:{
    InserirAluno:async function(){
        var bi = document.getElementById('bialuno').value;
        var datanasc = document.getElementById('dataaluno').value;
        var nomecompleto = document.getElementById('nomealuno').value;
        var comuna = document.getElementById('comunaaluno').value;
        var municipio = document.getElementById('municipioaluno').value;
        var provincia = document.getElementById('provinciaaluno').value;
        var endereco = document.getElementById('enderecoaluno').value;
        var sexo = document.getElementById('sexoaluno').value;
        var telefone = document.getElementById('telefonealuno').value;
        var email = document.getElementById('emailaluno').value;
        var obs = document.getElementById('obsaluno').value;
        var procedencia = document.getElementById('procedenciaaluno').value;
        var cursomedio = document.getElementById('cursomedioaluno').value;
        var trabalhador = document.getElementById('trablhador').value;
        var cc = '1';
        if (!document.getElementById('cc').value) {
          cc = '0';
        }
        

        var expresion = /^[a-z][\w.-]+@\w[\w.-]+\.[\w.-]*[a-z][a-z]$/i;
        var expresiontele = /^[0-9]{9}$/i;
        var expresionbi = /^[0-9]{9}[A-Z]{2}[0-9]{3}$/i;

        if(!expresion.test(email)){
           Swal.fire({
              type: 'error',
              title: 'Email com formato incorreto.',                        
            }) 
        }
        else if(!expresiontele.test(telefone)){
          Swal.fire({
              type: 'error',
              title: 'Telefone com formato incorreto.',                        
            }) 
        }
        else if (!expresionbi.test(bi)){
          Swal.fire({
              type: 'error',
              title: 'BI com formato incorreto.',                        
            }) 
        }       
        else if(datanasc == "" || nomecompleto == "" || endereco == "" || sexo == ""){
            Swal.fire({
              type: 'error',
              title: 'Dados incompletos.',                        
            }) 
          }         
        else{          
              var url = "./controlador/aluno.php"; 
              axios.post(url, {opcao:1,bi:bi,datanasc:datanasc,nomecompleto:nomecompleto,comuna:comuna,municipio:municipio,provincia:provincia,endereco:endereco,sexo:sexo,telefone:telefone,email:email,obs:obs,procedencia:procedencia,cursomedio:cursomedio,trabalhador:trabalhador,cc:cc}).then(response =>{
                  var aux = response.data;
                  if(aux == "1"){
                    this.listarultimos25();                    
                    document.getElementById('bialuno').value='';                    
                    document.getElementById('nomealuno').value='';                    
                    document.getElementById('enderecoaluno').value='';                   
                    document.getElementById('telefonealuno').value = '';
                    document.getElementById('emailaluno').value='';
                    document.getElementById('obsaluno').value='';                                 
                    const Toast = Swal.mixin({
                      toast: true,
                      position: 'top-end',
                      showConfirmButton: false,
                      timer: 5000
                    });
                    Toast.fire({
                      type: 'success',
                      title: 'Aluno inserido com sucesso!'
                    });
                    $('#inserirAlunoModal').modal('hide');  
                  }
                  else{
                    Swal.fire({
                      type: 'error',
                      title: ''+aux,                        
                    }) 

                  }
                  
              });                   
          }     
    },  
    btnEliminar:function(bi){
        this.bi = bi;        
    },
    Eliminar:async function(){
      var url = "./controlador/aluno.php";
        axios.post(url, {opcao:3,bi:this.bi}).then(response =>{
            var aux = response.data;
            if(aux == "1"){
              this.listarultimos25();                            
              const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 5000
              });
              Toast.fire({
                type: 'success',
                title: 'Aluno excluído com sucesso!'
              });
              $('#excluiAlunoModal').modal('hide');  
            }
            else{
              Swal.fire({
                type: 'error',
                title: ''+aux,                        
              }) 

            }              
        });      

    },  
    btnAlterar:function(bi,datanasc,nomecompleto,comuna,municipio,provincia,endereco,sexo,telefone,email,obs,procedencia,cursomedio,trabalhador,cc){
      this.bi = bi;      
      this.listarProvinciasM();
      this.nomeprovinciam = provincia;
      this.listarMunicipiosProvM(provincia);
      this.nomemunicipiom = municipio;
      this.listarComunasPorMunicipioseProvM(provincia,municipio);            
      this.nomecomunam = comuna;
      this.procedenciam = procedencia;
      this.cursomediom = cursomedio;
      this.trabalhadorm = trabalhador;
      document.getElementById('nomealunom').value = nomecompleto;      
      document.getElementById('enderecoalunom').value = endereco;
      document.getElementById('bialunom').value = bi;
      document.getElementById('dataalunom').value = datanasc;
      document.getElementById('telefonealunom').value = telefone;
      document.getElementById('emailalunom').value = email;
      document.getElementById('sexoalunom').value = sexo;
      document.getElementById('obsalunom').value = obs; 

      if(cc == 1){         
        
        this.ccm = 1;        
      }
      else{
        
        this.ccm = 0;
      }     
    },  
    Alterar:async function(){
      var nome = document.getElementById('nomealunom').value;
      var provincia = document.getElementById('provinciaalunom').value;
      var municipio = document.getElementById('municipioalunom').value;
      var comuna = document.getElementById('comunaalunom').value;
      var endereco=document.getElementById('enderecoalunom').value;
      var bi = document.getElementById('bialunom').value;
      var datanasc = document.getElementById('dataalunom').value;
      var telefone = document.getElementById('telefonealunom').value;
      var email = document.getElementById('emailalunom').value;
      var sexo = document.getElementById('sexoalunom').value;
      var obs = document.getElementById('obsalunom').value;
      var procedencia = document.getElementById('procedenciaalunom').value;
      var cursomedio = document.getElementById('cursomedioalunom').value;
      var trabalhador = document.getElementById('trabalhadorm').value;

      var expresion = /^[a-z][\w.-]+@\w[\w.-]+\.[\w.-]*[a-z][a-z]$/i;
      var expresiontele = /^[0-9]{9}$/i;
      var expresionbi = /^[0-9]{9}[A-Z]{2}[0-9]{3}$/i;

      if(!expresion.test(email)){
         Swal.fire({
            type: 'error',
            title: 'Email com formato incorreto.',                        
          }) 
      }
      else if(!expresiontele.test(telefone)){
        Swal.fire({
            type: 'error',
            title: 'Telefone com formato incorreto.',                        
          }) 
      }       
      else if(datanasc == "" || nome == "" || endereco == "" || sexo == ""){
          Swal.fire({
            type: 'error',
            title: 'Dados incompletos.',                        
          }) 
        }                  
      else{          
          var url = "./controlador/aluno.php";
          axios.post(url, {opcao:2,bia:this.bi,bi:bi,datanasc:datanasc,nome:nome,comuna:comuna,municipio:municipio,provincia:provincia,endereco:endereco,sexo:sexo,telefone:telefone,email:email,obs:obs,procedencia:procedencia,cursomedio:cursomedio,trabalhador:trabalhador,ccm:this.ccm}).then(response =>{
              var aux = response.data;
              if(aux == "1"){
                this.listarultimos25();
                const Toast = Swal.mixin({
                  toast: true,
                  position: 'top-end',
                  showConfirmButton: false,
                  timer: 5000
                });
                Toast.fire({
                  type: 'success',
                  title: 'Aluno alterado com sucesso!!'
                });
                $('#alterarAlunoModal').modal('hide');  
              }
              else{
                Swal.fire({
                  type: 'error',
                  title: ''+aux,                        
                }) 

              }
              
          });                   
      }
    }, 
    info:function(bi,datanasc,nomecompleto,comuna,municipio,provincia,endereco,sexo,telefone,email,obs,procedencia,cursomedio,trabalhador,userid,cc){
      this.bii = bi;
      this.datanasci = datanasc;
      this.nomecompletoi = nomecompleto;
      this.comunai = comuna;
      this.municipioi = municipio;
      this.provinciai = provincia;
      this.enderecoi = endereco;
      this.sexoi = sexo;
      this.telefonei = telefone;
      this.emaili = email;
      this.obsi = obs;
      this.procedenciai = procedencia;
      this.cursomedioi = cursomedio;
      this.trabalhadori = trabalhador;
      this.useri = userid;
      if(cc == '1'){
        this.cci = "Sim";
      }
      else{
        this.cci = "Não";
      }
    },
    listarultimos25:async function(){
        var url = "./controlador/aluno.php";
        axios.post(url, {opcao:-1}).then(response =>{
            this.alunos = response.data;                                                  
        });
    },
    procurarAluno:async function()
    { 
      if(this.procuraralunobi.length == 0)
      {
        this.listarultimos25();
      }
      else
      {
        var url = "./controlador/aluno.php";
        axios.post(url, {opcao:-2,bi:this.procuraralunobi}).then(response =>{
            this.alunos = response.data;                                                  
        });
      }     
      
    },
    listarMunicipiosProv:async function(provincia){
        var url = "./controlador/municipio.php";
        axios.post(url, {opcao:5,nomeprov:provincia}).then(response =>{
            this.municipios = response.data;    
            this.nomemunicipio = this.municipios[0].nomem;
            this.nomemunicipiom = this.municipios[0].nomem;
            var url3 = "./controlador/comuna.php";
            axios.post(url3, {opcao:6,nomep:provincia,nomem:this.municipios[0].nomem}).then(response =>{
              this.comunas = response.data; 
              this.nomecomuna = this.comunas[0].nomecomuna; 
              this.nomecomunam = this.comunas[0].nomecomuna;                   
            });                                            
        });
    },
    listarMunicipiosProvM:async function(provincia){
        var url = "./controlador/municipio.php";
        axios.post(url, {opcao:5,nomeprov:provincia}).then(response =>{
            this.municipios = response.data;                                             
        });
    },
    listarProvincias:async function(){
        var url = "./controlador/provincia.php";
        axios.post(url, {opcao:4}).then(response =>{
            this.provincias = response.data;
            this.nomeprovincia = this.provincias[0].nome;
            this.nomeprovinciam = this.provincias[0].nome;
            var url2 = "./controlador/municipio.php";
            axios.post(url2, {opcao:5,nomeprov:this.provincias[0].nome}).then(response =>{
                this.municipios = response.data;                 
                this.nomemunicipio = this.municipios[0].nomem; 
                this.nomemunicipiom = this.municipios[0].nomem;                
                var url3 = "./controlador/comuna.php";
                axios.post(url3, {opcao:6,nomep:this.provincias[0].nome,nomem:this.municipios[0].nomem}).then(response =>{
                  this.comunas = response.data; 
                  this.nomecomuna = this.comunas[0].nomecomuna;     
                   this.nomecomunam = this.comunas[0].nomecomuna;                    
                });      
            });
        });
    },
    listarProvinciasM:async function(){
        var url = "./controlador/provincia.php";
        axios.post(url, {opcao:4}).then(response =>{
            this.provincias = response.data;    
        });
    },
    listarComunasPorMunicipioseProv:async function(nomep,nomem){
        var url = "./controlador/comuna.php";
        axios.post(url, {opcao:6,nomep:nomep,nomem:nomem}).then(response =>{
            this.comunas = response.data; 
            this.nomecomuna = this.comunas[0].nomecomuna;   
            this.nomecomunam = this.comunas[0].nomecomuna;                                          
        });
    },
    listarComunasPorMunicipioseProvM:async function(nomep,nomem){
        var url = "./controlador/comuna.php";
        axios.post(url, {opcao:6,nomep:nomep,nomem:nomem}).then(response =>{
            this.comunas = response.data;                                                  
        });
    },
    listarProcedencia:async function(){
        var url = "./controlador/procedencia.php";
        axios.post(url, {opcao:4}).then(response =>{
            this.procedencias = response.data; 
            this.procedencia = 'PUNIV';   
        });
    },
    listarCursosMedio:async function(){
        var url = "./controlador/cursomedio.php";
        axios.post(url, {opcao:4}).then(response =>{
            this.cursosmedio = response.data; 
            this.cursomedio = this.cursosmedio[0].nome;   
        });
    },
    listarCursosMedioProcedencia:async function(){
        this.listarProcedencia();
        this.listarCursosMedio();
    }
  },  
  created: function(){ 
    this.listarultimos25();
    this.listarProvincias();  
    this.listarCursosMedioProcedencia();                   
  }
});
/*----------------------Processo--------------------------------------------*/
var processo = new Vue({
  el:"#processo",
  data:{
    processos:[],
    ano:''           
  },
  methods:{
     btnInserir: async function(){            
          ano = document.getElementById('anoprocesso').value;

          if(ano == ""){
              Swal.fire({
                type: 'error',
                title: 'Dados incompletos.',                        
              }) 
            }             
            else{          
                var url = "./controlador/processo.php";
                axios.post(url, {opcao:1,ano:ano}).then(response =>{
                    var aux = response.data;
                    if(aux == "1"){
                      this.listarProcesso();
                      document.getElementById('anoprocesso').value='';                                                           
                      const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 5000
                      });
                      Toast.fire({
                        type: 'success',
                        title: 'Processo inserido com sucesso!'
                      });
                      $('#inserirprocessoModal').modal('hide');  
                    }
                    else{
                      Swal.fire({
                        type: 'error',
                        title: ''+aux,                        
                      }) 

                    }                    
                });                   
            }
        },
    Eliminar:function(ano){
      this.ano = ano;
    },
    btnEliminar:async function(){
        var url = "./controlador/processo.php";
        axios.post(url, {opcao:2,ano:this.ano}).then(response =>{
            var aux = response.data;
            if(aux == "1"){                               
              const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 5000
              });
              Toast.fire({
                type: 'success',
                title: 'Processo eliminado com sucesso!'
              });
              $('#excluirprocessoModal').modal('hide'); 
              this.listarProcesso(); 
            }
            else{
              Swal.fire({
                type: 'error',
                title: ''+aux,                        
              }) 

            }
            
        });
    },    
    listarProcesso: async function(){
        var url = "./controlador/processo.php";
        axios.post(url, {opcao:4}).then(response =>{
           this.processos = response.data;       
        });
    }
  },
  created: function(){            
      this.listarProcesso();            
   }
});
/*----------------------Procedência Escolar de Ensino Médio --------------------------------------------*/
var procedencia = new Vue({
  el:"#procedencias",
  data:{
    procedencias:[],
    nome:''           
  },
  methods:{
     btnInserir: async function(){            
          nome = document.getElementById('nomeprocedencia').value;

          if(nome == ""){
              Swal.fire({
                type: 'error',
                title: 'Dados incompletos.',                        
              }) 
            } 
            else{          
                var url = "./controlador/procedencia.php";
                axios.post(url, {opcao:1,nome:nome}).then(response =>{
                    var aux = response.data;
                    if(aux == "1"){
                      this.listarProcedecncias();
                      document.getElementById('nomeprocedencia').value='';                                                              
                      const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 5000
                      });
                      Toast.fire({
                        type: 'success',
                        title: 'Procedência Escolar de Ensino Médio inserida com sucesso!'
                      });
                      $('#inserirprocedenciaModal').modal('hide');  
                    }
                    else{
                      Swal.fire({
                        type: 'error',
                        title: ''+aux,                        
                      }) 

                    }                    
                });                   
            }
        },
    Eliminar:function(nomeprocedencia){
      this.nome = nomeprocedencia;
    },
    btnEliminar:async function(){
        var url = "./controlador/procedencia.php";
        axios.post(url, {opcao:2,nome:this.nome}).then(response =>{
            var aux = response.data;
            if(aux == "1"){                               
              const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 5000
              });
              Toast.fire({
                type: 'success',
                title: 'Procedência Escolar de Ensino Médio eliminada com sucesso!'
              });
              $('#excluirprocedenciaModal').modal('hide'); 
              this.listarProcedecncias(); 
            }
            else{
              Swal.fire({
                type: 'error',
                title: ''+aux,                        
              }) 

            }
            
        });
    },
    Alterar:function(nome){
      this.nome = nome;
      document.getElementById('nomeprocedenciaa').value = nome;      
    },
    btnAlterar:async function(){
      var nome = document.getElementById('nomeprocedenciaa').value;      
      if(nome == ""){
        Swal.fire({
          type: 'error',
          title: 'Dados incompletos.',                        
        }) 
      } 
      else{          
          var url = "./controlador/procedencia.php";
          axios.post(url, {opcao:3,nomea:this.nome,nome:nome}).then(response =>{
              var aux = response.data;
              if(aux == "1"){
                this.listarProcedecncias();
                document.getElementById('nomeprocedenciaa').value='';                                                         
                const Toast = Swal.mixin({
                  toast: true,
                  position: 'top-end',
                  showConfirmButton: false,
                  timer: 5000
                });
                Toast.fire({
                  type: 'success',
                  title: 'Procedência Escolar de Ensino Médio alterada com sucesso!'
                });
                $('#alterarprocedenciaModal').modal('hide');  
              }
              else{
                Swal.fire({
                  type: 'error',
                  title: ''+aux,                        
                }) 

              }                    
          });                   
      }
    },
    listarProcedecncias: async function(){
        var url = "./controlador/procedencia.php";
        axios.post(url, {opcao:4}).then(response =>{
           this.procedencias = response.data;       
        });
    }
  },
  created: function(){            
      this.listarProcedecncias();            
   }
});
/*-----------------------Curso do Ensino Médio --------------------------------------------*/
var cursoensinomedio = new Vue({
  el:"#cursoensinomedio",
  data:{
    cursosmedio:[],
    nome:''           
  },
  methods:{
     btnInserir: async function(){            
          nome = document.getElementById('nomecursomedio').value;

          if(nome == ""){
              Swal.fire({
                type: 'error',
                title: 'Dados incompletos.',                        
              }) 
            } 
            else{          
                var url = "./controlador/cursomedio.php";
                axios.post(url, {opcao:1,nome:nome}).then(response =>{
                    var aux = response.data;
                    if(aux == "1"){
                      this.listarCursosMedio();
                      document.getElementById('nomecursomedio').value='';                                                              
                      const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 5000
                      });
                      Toast.fire({
                        type: 'success',
                        title: 'Curso de Ensino Médio inserido com sucesso!!!'
                      });
                      $('#inserircursomedioModal').modal('hide');  
                    }
                    else{
                      Swal.fire({
                        type: 'error',
                        title: ''+aux,                        
                      }) 

                    }                    
                });                   
            }
        },
    Eliminar:function(nome){
      this.nome = nome;
    },
    btnEliminar:async function(){
        var url = "./controlador/cursomedio.php";
        axios.post(url, {opcao:2,nome:this.nome}).then(response =>{
            var aux = response.data;
            if(aux == "1"){                               
              const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 5000
              });
              Toast.fire({
                type: 'success',
                title: 'Curso de Ensino Médio eliminado com sucesso!'
              });
              $('#excluircursoModal').modal('hide'); 
              this.listarCursosMedio(); 
            }
            else{
              Swal.fire({
                type: 'error',
                title: ''+aux,                        
              }) 

            }
            
        });
    },
    Alterar:function(nome){
      this.nome = nome;
      document.getElementById('nomecursomedioa').value = nome;      
    },
    btnAlterar:async function(){
      var nome = document.getElementById('nomecursomedioa').value;      
      if(nome == ""){
        Swal.fire({
          type: 'error',
          title: 'Dados incompletos.',                        
        }) 
      } 
      else{          
          var url = "./controlador/cursomedio.php";
          axios.post(url, {opcao:3,nomea:this.nome,nome:nome}).then(response =>{
              var aux = response.data;
              if(aux == "1"){
                this.listarCursosMedio();
                document.getElementById('nomecursomedioa').value='';                                                         
                const Toast = Swal.mixin({
                  toast: true,
                  position: 'top-end',
                  showConfirmButton: false,
                  timer: 5000
                });
                Toast.fire({
                  type: 'success',
                  title: 'Curso de Ensino Médio alterado com sucesso!'
                });
                $('#alterarcursoModal').modal('hide');  
              }
              else{
                Swal.fire({
                  type: 'error',
                  title: ''+aux,                        
                }) 

              }                    
          });                   
      }
    },
    listarCursosMedio: async function(){
        var url = "./controlador/cursomedio.php";
        axios.post(url, {opcao:4}).then(response =>{
           this.cursosmedio = response.data;       
        });
    }
  },
  created: function(){            
      this.listarCursosMedio();            
   }
});
/*-----------------------Inscrição--------------------------------------------*/
var inscricao = new Vue({
  el:"#inscricao",
  data:{
    anos:[],
    ano:'',
    inscricoes:[],
    cursos:[],
    bi:'',   
    anoi:'',
    cursosinscribidos:[],
    cursosinscribidosp:[],
    bii:'',
    nomei:'',
    useridincribir:'',
    procurarbiincrivir:''       
  },
  methods:{
    btnInserir: async function(){            
          bi = document.getElementById('bialunoinscrever').value;
          ano = document.getElementById('anoinscricao').value;          
          var cursosinsc = $('#cursosinscricao').val();
          var cursosinscp = $('#cursosinscricaop').val();

          if(bi.length != 14){
              Swal.fire({
                type: 'error',
                title: 'Dados incompletos.',                        
              }) 
          } 
          else if(cursosinsc.length == 0 && cursosinscp.length == 0){
            Swal.fire({
                type: 'error',
                title: 'Deve selecionar ao menos um curso.',                        
              }) 
          }
          else{          
                var url = "./controlador/inscricao.php";
                axios.post(url, {opcao:1,bi:bi,ano:ano,cursos:cursosinsc,cursosp:cursosinscp}).then(response =>{
                    var aux = response.data;
                    if(aux == "1"){
                      this.listarInscriocoes();   
                      document.getElementById('bialunoinscrever').value = "";
                      document.getElementById('cursosinscricao').value = "";  
                       document.getElementById('cursosinscricaop').value = "";                                                   
                      const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 5000
                      });
                      Toast.fire({
                        type: 'success',
                        title: 'Inscrição inserida com sucesso!!!'
                      });
                      $('#inseririnscricaoModal').modal('hide');  
                    }
                    else{
                      Swal.fire({
                        type: 'error',
                        title: ''+aux,                        
                      }) 

                    }                    
                });                   
            }
        },
    Eliminar:function(bi,ano){
      this.bi = bi;
      this.ano = ano;

    },
    btnEliminar:async function(){
        var url = "./controlador/inscricao.php";
        axios.post(url, {opcao:2,bi:this.bi,ano:this.ano}).then(response =>{
            var aux = response.data;
            if(aux == "1"){                               
              const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 5000
              });
              Toast.fire({
                type: 'success',
                title: 'Inscrição eliminada com sucesso!'
              });
              $('#excluirinscricaoModal').modal('hide'); 
              this.listarInscriocoes();
            }
            else{
              Swal.fire({
                type: 'error',
                title: ''+aux,                        
              }) 

            }
            
        });
    },    
    listarAnos: async function(){
        var url = "./controlador/processo.php";
        axios.post(url, {opcao:4}).then(response =>{
           this.anos = response.data;
           var data = new Date();
           this.ano = data.getFullYear();            
        });
    },
    listarInscriocoes: async function(){
        var url = "./controlador/inscricao.php";
        axios.post(url, {opcao:4}).then(response =>{
           this.inscricoes = response.data;                
        });
    },
    listarCursos: async function(){
        var url = "./controlador/cursos.php";
        axios.post(url, {opcao:4}).then(response =>{
           this.cursos = response.data;       
        });
    },
    info:function(bi,ano,userid){
      this.anoi = ano;
      this.bii = bi;      
      this.useridincribir = userid;
      var url = "./controlador/inscricao.php";
      axios.post(url, {opcao:3,bi:bi,ano:ano,perido:'Regular'}).then(response =>{
         this.cursosinscribidos = response.data;       
      });
      var url3 = "./controlador/inscricao.php";
      axios.post(url3, {opcao:3,bi:bi,ano:ano,perido:'Pos Laboral'}).then(response =>{
         this.cursosinscribidosp = response.data;       
      });
      var url2 = "./controlador/inscricao.php";
      axios.post(url2, {opcao:5,bi:bi}).then(response =>{
         this.nomei = response.data[0];       
      });
    },
    procurarAluno: async function(){
      if(this.procurarbiincrivir.length == 0)
      {
        this.listarInscriocoes();
      }
      else
      {
        var url = "./controlador/inscricao.php";
        axios.post(url, {opcao:-1,bi:this.procurarbiincrivir}).then(response =>{
            this.inscricoes = response.data;                                                  
        });
      }     
    }
  },
  
  created: function(){            
      this.listarAnos(); 
      this.listarInscriocoes(); 
      this.listarCursos();          
   }
});
/*-----------------------Pagamento--------------------------------------------*/
var pagamento = new Vue({
  el:"#pagamento",
  data:{
    anos:[],
    bancos:[],
    ano:'',
    banco:'',
    inscricoescompagamento:[],
    bi:'',
    ano:'',
    bii:'',
    nomei:'',
    cursosinscribidos:[],
    cursosinscribidosp:[],   
    anoi:'',
    valori:'',
    bancoi:'',
    codigoi:'',
    procurarbipago:'',
    useridpgai:'',
    nomeidpago:'',
    data:'',
    correcto:'',
    mostrar:'',
    quantD:'',
    quantP:''

  },
  methods:{
    btnInserir: async function(){            
          bi = document.getElementById('bialunopagar').value.replace("&nbsp;","");
          ano = document.getElementById('anopagar').value;
          banco = document.getElementById('bancopago').value;
          valor = document.getElementById('valorpago').value.replace("&nbsp;","");
          codigo = document.getElementById('codreferencia').value.replace("&nbsp;","");        

          if(bi.length != 14 || valor.length == 0 || codigo.length == 0){
            Swal.fire({
              type: 'error',
              title: 'Dados incompletos.',                        
            }) 
          }
          else if(!this.validateDecimal(valor))
          {
            Swal.fire({
              type: 'error',
              title: 'Pago com formato incorreto.',                        
            }) 
          }
          else{          
              var url = "./controlador/inscricao.php";
              axios.post(url, {opcao:7,bi:bi,ano:ano,banco:banco,valor:valor,codigo:codigo}).then(response =>{
                  var aux = response.data;
                  if(aux == "1"){
                    this.correcto = '';
                    this.mostrar = '';
                    this.listarInscriocoespagas();   
                    document.getElementById('bialunopagar').value = "";  
                    document.getElementById('valorpago').value = "";   
                    document.getElementById('codreferencia').value = "";                                 
                    const Toast = Swal.mixin({
                      toast: true,
                      position: 'top-end',
                      showConfirmButton: false,
                      timer: 5000
                    });
                    Toast.fire({
                      type: 'success',
                      title: 'Pagamento inserida com sucesso!!!'
                    });
                    $('#inserirpagoModal').modal('hide');  
                  }
                  else if(aux == "0"){
                    Swal.fire({
                      type: 'error',
                      title: 'Aluno não inscrito ou já realizou um pagamento anterior!!!',                        
                    }) 
                  }
                  else{
                    Swal.fire({
                      type: 'error',
                      title: ''+aux,                        
                    }) 
                  }                    
              });                   
          }
        },
    Eliminar:function(bi,ano){
      this.bi = bi;
      this.ano = ano;

    },
    btnEliminar:async function(){
        var url = "./controlador/inscricao.php";
        axios.post(url, {opcao:8,bi:this.bi,ano:this.ano}).then(response =>{
            var aux = response.data;
            if(aux == "1"){                               
              const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 5000
              });
              Toast.fire({
                type: 'success',
                title: 'Inscrição eliminada com sucesso!'
              });
              $('#excluirPagamentoModal').modal('hide'); 
              this.listarInscriocoespagas();
            }
            else{
              Swal.fire({
                type: 'error',
                title: ''+aux,                        
              }) 

            }
            
        });
    },    
    listarAnos: async function(){
        var url = "./controlador/processo.php";
        axios.post(url, {opcao:4}).then(response =>{
           this.anos = response.data;
           var data = new Date();
           this.ano = data.getFullYear();            
        });
    },
    listarBancos: async function(){
      var url = "./controlador/bancos.php";
      axios.post(url, {opcao:4}).then(response =>{
         this.bancos = response.data; 
         this.banco = this.bancos[0].nome;                
      });
    },
    listarInscriocoespagas: async function(){
        var url = "./controlador/inscricao.php";
        axios.post(url, {opcao:6}).then(response =>{
           this.inscricoescompagamento = response.data;                
        });
    },  
    validateDecimal:function(valor){
      var RE = /^\d*\.?\d*$/;
      if(RE.test(valor))
      {
        return true;
      }
      else
      {
        return false;
      }
    },  
    info:function(bi,ano,valores,banco,codigo,useridpago,data){
      this.anoi = ano;
      this.bii = bi;     
      this.valori = valores;
      this.bancoi = banco;
      this.codigoi = codigo;
      this.useridpgai = useridpago;
      this.data = data;


      var url3 = "./controlador/usuario.php";
      axios.post(url3, {opcao:-1,id:useridpago}).then(response =>{
         this.nomeidpago = response.data[0];       
      });
      var url = "./controlador/inscricao.php";
        axios.post(url, {opcao:3,bi:bi,ano:ano,perido:'Regular'}).then(response =>{
           this.cursosinscribidos = response.data; 
           this.quantD = this.cursosinscribidos.length;      
        });
      var url4 = "./controlador/inscricao.php";
      axios.post(url4, {opcao:3,bi:bi,ano:ano,perido:'Pos Laboral'}).then(response =>{
         this.cursosinscribidosp = response.data;
         this.quantP = this.cursosinscribidosp.length;       
      });
      var url2 = "./controlador/inscricao.php";
      axios.post(url2, {opcao:5,bi:bi}).then(response =>{
         this.nomei = response.data[0];       
      });
    },
    infoCursos: async function(){
      bi = document.getElementById('bialunopagar').value.replace("&nbsp;","");
      if (bi.length == 14) {
        var url = "./controlador/inscricao.php";
        axios.post(url, {opcao:3,bi:bi,ano:this.ano,perido:'Regular'}).then(response =>{
           this.cursosinscribidos = response.data; 
           this.quantD = this.cursosinscribidos.length;      
        });
        var url3 = "./controlador/inscricao.php";
        axios.post(url3, {opcao:3,bi:bi,ano:this.ano,perido:'Pos Laboral'}).then(response =>{
           this.cursosinscribidosp = response.data;
           this.quantP = this.cursosinscribidosp.length;       
        });
        this.correcto = "True";
      }      
    },
    MostrarInfo: function(){
      if (this.mostrar=='') {
        this.mostrar = "True";
      }
      else{
        this.mostrar = '';
      }
    },
    printTabela: function(chave)
    {
      var divToPrint=document.getElementById(chave);
      newWin= window.open("");
      newWin.document.write(divToPrint.outerHTML);
      newWin.print();
      newWin.close();
    },
    imprimirrecibor:function(){   
      this.printTabela('recibopagamento');
    },
    procurarAluno: async function(){
      if(this.procurarbipago.length == 0)
      {
        this.listarInscriocoespagas(); 
      }
      else
      {
        var url = "./controlador/inscricao.php";
        axios.post(url, {opcao:-2,bi:this.procurarbipago}).then(response =>{
            this.inscricoescompagamento = response.data;                                                  
        });
      }     
    }
  },
  created: function(){            
      this.listarAnos();
      this.listarInscriocoespagas();  
      this.listarBancos();              
   }
});
/*----------------------Turmas--------------------------------------------*/
var formarturmas = new Vue({
  el:"#turmas",
  data:{
    cursos:[],
    quantidade:25,
    curso:'',
    lista:[],
    listacompleta:[],
    anos:[],
    ano:'',
    periodo:'Regular',
    total:'',
    turmas:'',
    turmaX:'',
    pronto:'', 
    /* ---Dados para imprimir---*/ 
    noaluno:'',
    nomealuno:'',
    bialuno:'',
    periodoaluno:'',
    anoaluno:'',
    cursoaluno:'',
    dataaluno:'',
    horaaluno:'9h',
    salaaluno:'',
    turmaaluno:'',
    duracao:'120 min'            
  },
  methods:{
    listarCursos: async function(){
        var url = "./controlador/cursos.php";
        axios.post(url, {opcao:4}).then(response =>{
           this.cursos = response.data; 
           this.curso = this.cursos[0].nome;
        });
    },
    listarAnos: async function(){
        var url = "./controlador/processo.php";
        axios.post(url, {opcao:4}).then(response =>{
           this.anos = response.data;
           var data = new Date();
           this.ano = data.getFullYear();            
        });
    },
    FormarTurmas: async function(){      
      this.pronto = "True";
      var posicao = 0;
      var url = "./controlador/turmas.php";
      axios.post(url, {opcao:1,quantidade:this.quantidade,pos:posicao,curso:this.curso,ano:this.ano,periodo:this.periodo}).then(response =>{
         this.lista = response.data;                
      });
      var url2 = "./controlador/turmas.php";
      axios.post(url2, {opcao:2,curso:this.curso,ano:this.ano,periodo:this.periodo}).then(response =>{
         this.total = response.data[0]; 
         if(this.total % this.quantidade == 0){
            this.turmas = this.total/this.quantidade;
            if(this.turmas == 0){
              this.turmaX = '0';
            }
            else{
              this.turmaX = 1;
            }
          }
          else{
            this.turmas = Math.trunc(this.total/this.quantidade) + 1;
            this.turmaX = 1;
          }               
      });
      this.CursoCompleto();
      
    },
    CursoCompleto: async function(){
       this.pronto = "True";
      var posicao = 0;
      var url = "./controlador/turmas.php";
      axios.post(url, {opcao:3,curso:this.curso,ano:this.ano,periodo:this.periodo}).then(response =>{
         this.listacompleta = response.data;                
      });

    },
    TurmaSiguinte: async function(){
      var aux = this.turmaX + 1;

      if(aux > this.turmas){
        Swal.fire({
          type: 'error',
          title: 'Não existem mais Turmas!!!',                        
        }) 
      }
      else{
          var posicao = this.turmaX * this.quantidade;
          var url = "./controlador/turmas.php";
          axios.post(url, {opcao:1,quantidade:this.quantidade,pos:posicao,curso:this.curso,ano:this.ano,periodo:this.periodo}).then(response =>{
            this.lista = response.data; 
            this.turmaX = this.turmaX+1;               
          });

      }    
    },
    TurmaAnterior: async function(){
      
      if(this.turmaX == 1){
        Swal.fire({
          type: 'error',
          title: 'Já estamos na primeira Turma!!!',                        
        }) 
      }
      else{
          this.turmaX = this.turmaX - 1;
          var posicao = (this.turmaX - 1) * this.quantidade;
          var url = "./controlador/turmas.php";
          axios.post(url, {opcao:1,quantidade:this.quantidade,pos:posicao,curso:this.curso,ano:this.ano,periodo:this.periodo}).then(response =>{
            this.lista = response.data;                            
          });

      }    
    },
    Imprimir: async function(nomecompleto,bi,no){
      this.noaluno = no;
      this.bialuno = bi;
      this.nomealuno = nomecompleto;
      this.periodoaluno = document.getElementById('periodoturma').value;
      this.anoaluno = document.getElementById('anoturma').value;
      this.cursoaluno = document.getElementById('cursoturma').value;
      this.dataaluno = document.getElementById('dataturma').value;
      this.horaaluno = document.getElementById('horaturma').value;
      this.salaaluno = document.getElementById('nomesala').value;
      this.turmaaluno = document.getElementById('nometurma').value;
     
      $("#barcode").JsBarcode(this.bialuno,{displayValue: false});
      $("#barcode2").JsBarcode(this.bialuno,{displayValue: false});
      

      this.printTabela('informacaoaluno');
    },
    ImprimirTudo:function(){  
      $(".muebarcode").each(function(){
          $("#"+$(this).attr("id")).JsBarcode($(this).attr("id"),{displayValue: false});          
      });
      $(".muebarcode2").each(function(){
          $("#"+$(this).attr("id")).JsBarcode($(this).attr("data"),{displayValue: false});          
      });    
      this.printTabela('infobarcodetudo');
    },

    printTabela: function(chave)
    {
      var divToPrint=document.getElementById(chave);
      newWin= window.open("");
      newWin.document.write(divToPrint.outerHTML);
      newWin.print();
      newWin.close();
    },
    ExportarTurma:function(){      
      this.printTabela("exportarexcelturma");      
    },
    ExportarCurso: function(){
      this.printTabela("exportarcursopdf");
    }
    
  }, 
  created: function(){            
          
        this.listarAnos(); 
        this.listarCursos();

   }
});
/*----------------------NOTAS # 1--------------------------------------------*/
var notas1 = new Vue({
  el:"#notas1",
  data:{
    cursos:[],    
    curso:'',
    listanotas:[],    
    anos:[],
    ano:'',
    periodo:'Regular',
    binota1:'',
    bia:'',
    notaa:'',
    procurarbi:''           
  },
  methods:{
    listarCursos: async function(){
        var url = "./controlador/cursos.php";
        axios.post(url, {opcao:4}).then(response =>{
            this.cursos = response.data; 
            this.curso = this.cursos[0].nome;

            var url2 = "./controlador/processo.php";
            axios.post(url2, {opcao:4}).then(response =>{
               this.anos = response.data;
               var data = new Date();
               this.ano = data.getFullYear();

              var url3 = "./controlador/nota.php";
              axios.post(url3, {opcao:4,ano:this.ano,curso:this.curso,periodo:this.periodo}).then(response =>{
                 this.listanotas = response.data;             
               });

            });
        });
    }, 
    listarNotas: async function(){
        this.procurarbi = '';
        var url3 = "./controlador/nota.php";
        axios.post(url3, {opcao:4,ano:this.ano,curso:this.curso,periodo:this.periodo}).then(response =>{
           this.listanotas = response.data;  

        });
    }, 
    Inserir: async function(){            
      bi = document.getElementById('bialunonota1').value.replace("&nbsp;","");
      nota = document.getElementById('notaconv1').value.replace("&nbsp;","");      

      if(bi.length != 14){
        Swal.fire({
          type: 'error',
          title: 'Dados incompletos.',                        
        }) 
      }
      else if(!this.validateDecimal(nota))
      {
        Swal.fire({
          type: 'error',
          title: 'Nota com formato incorreto.',                        
        }) 
      }
      else if(parseFloat(nota) < 0 || parseFloat(nota) > 20){
        Swal.fire({
          type: 'error',
          title: 'Nota com valor incorreto. (0-20)',                        
        }) 

      }
      else{          
          var url = "./controlador/nota.php";
          axios.post(url, {opcao:1,bi:bi,ano:this.ano,curso:this.curso,periodo:this.periodo,nota:nota}).then(response =>{
              var aux = response.data;
              if(aux == "1"){                
                this.listarNotas();   
                document.getElementById('bialunonota1').value = "";  
                document.getElementById('notaconv1').value = "";  
                document.getElementById("bialunonota1").focus();                                            
                const Toast = Swal.mixin({
                  toast: true,
                  position: 'top-end',
                  showConfirmButton: false,
                  timer: 5000
                });
                Toast.fire({
                  type: 'success',
                  title: 'Nota inserida com sucesso!!!'
                });                
              }
              else if(aux == "0"){
                Swal.fire({
                  type: 'error',
                  title: 'Aluno não inscrito neste Curso,Ano,Período!!!',                        
                }) 
              }
              else if(aux == "2"){
                Swal.fire({
                  type: 'error',
                  title: 'Já existe uma nota para este aluno neste Curso,Ano,Período!!!',                        
                }) 
              }
              else{
                Swal.fire({
                  type: 'error',
                  title: ''+aux,                        
                }) 
              }                    
          });                   
      }
    }, 
    btnEliminar:function(bi){
      this.binota1 = bi;
    },
    Eliminar:async function(){
      var url = "./controlador/nota.php";
      axios.post(url, {opcao:2,ano:this.ano,curso:this.curso,periodo:this.periodo,bi:this.binota1}).then(response =>{
          var aux = response.data;
            if(aux == "1"){                               
              const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 5000
              });
              Toast.fire({
                type: 'success',
                title: 'Nota eliminada com sucesso!'
              });
              $('#excluirnota1Modal').modal('hide'); 
              this.listarNotas();
            }
            else{
              Swal.fire({
                type: 'error',
                title: ''+aux,                        
              }) 

            }             
       });
    },
    brnAlterar:function(bi,nota){
      this.bia = bi;
      this.notaa = nota;
    },
    Alterar: async function(){           

      if(!this.validateDecimal(this.notaa))
      {
        Swal.fire({
          type: 'error',
          title: 'Nota com formato incorreto.',                        
        }) 
      }
      else if(parseFloat(this.notaa) < 0 || parseFloat(this.notaa) > 20){
        Swal.fire({
          type: 'error',
          title: 'Nota com valor incorreto. (0-20)',                        
        }) 
      }
      else{          
          var url = "./controlador/nota.php";
          axios.post(url, {opcao:3,bi:this.bia,ano:this.ano,curso:this.curso,periodo:this.periodo,nota:this.notaa}).then(response =>{
              var aux = response.data;
              if(aux == "1"){                
                this.listarNotas();
                this.notaa = "";                                                   
                const Toast = Swal.mixin({
                  toast: true,
                  position: 'top-end',
                  showConfirmButton: false,
                  timer: 5000
                });
                Toast.fire({
                  type: 'success',
                  title: 'Nota alterada com sucesso!!!'
                });

                 $('#alterarnotaModal').modal('hide');                 
              }             
              else{
                Swal.fire({
                  type: 'error',
                  title: ''+aux,                        
                }) 
              }                    
          });                   
      }
    },
    procurarAluno: async function(){
      if(this.procurarbi.length == 0)
      {
        this.listarNotas(); 
      }
      else
      {
        var url = "./controlador/nota.php";
        axios.post(url, {opcao:7,ano:this.ano,curso:this.curso,periodo:this.periodo,bi:this.procurarbi}).then(response =>{
            this.listanotas = response.data;                                                  
        });
      }     
    },    
    validateDecimal:function(valor){
      var RE = /^\d*\.?\d*$/;
      if(RE.test(valor))
      {
        return true;
      }
      else
      {
        return false;
      }
    }   
  }, 
  created: function(){         
        this.listarCursos();
   }
});
/*----------------------Publicar notas # 1--------------------------------------------*/
var notas1 = new Vue({
  el:"#publicarnota1",
  data:{
    cursos:[],    
    curso:'',
    listanotas:[],    
    anos:[],
    ano:'',
    periodo:'Regular',        
  },
  methods:{
    listarCursos: async function(){
        var url = "./controlador/cursos.php";
        axios.post(url, {opcao:4}).then(response =>{
            this.cursos = response.data; 
            this.curso = this.cursos[0].nome;

            var url2 = "./controlador/processo.php";
            axios.post(url2, {opcao:4}).then(response =>{
               this.anos = response.data;
               var data = new Date();
               this.ano = data.getFullYear();       

            });
        });
    }, 
    listarNotas: async function(){
        var url3 = "./controlador/nota.php";
        axios.post(url3, {opcao:5,ano:this.ano,curso:this.curso,periodo:this.periodo}).then(response =>{
           this.listanotas = response.data;
        });
    }, 
    Admitir:async function(bi,valor){
        var url = "./controlador/nota.php";
        axios.post(url, {opcao:6,ano:this.ano,curso:this.curso,periodo:this.periodo,bi:bi,valor:valor}).then(response =>{
            var aux = response.data;
            if(aux == "1"){
              this.listarNotas();                 
            }
            else{
              Swal.fire({
                type: 'error',
                title: ''+aux,                        
              }) 

            }              
        });            

    },    
    Imprimir:async function(){
       this.printTabela('exportarnotas');
    },    
    printTabela: function(chave)
    {
      var divToPrint=document.getElementById(chave);
      newWin= window.open("");
      newWin.document.write(divToPrint.outerHTML);
      newWin.print();
      newWin.close();
    }
  }, 
  created: function(){         
        this.listarCursos();
   }
});

function pulsar(e){
  if(e.which === 13 && !e.shiftKey){
    e.preventDefault();
    return false;
  }
}

$(document).on('shown.bs.modal', '.modal', function () {
    $(this).find("input:visible:first").focus();
});


