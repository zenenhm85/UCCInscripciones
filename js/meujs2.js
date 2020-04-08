/*-----------------------Inscrição 2--------------------------------------------*/
var inscricao = new Vue({
  el:"#inscricao2",
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
          bi = document.getElementById('bialunoinscrever2').value;
          ano = document.getElementById('anoinscricao2').value;          
          var cursosinsc2 = $('#cursosinscricao2').val();
          var cursosinscp2 = $('#cursosinscricaop2').val();

          if(bi.length != 14){
              Swal.fire({
                type: 'error',
                title: 'Dados incompletos.',                        
              }) 
          } 
          else if(cursosinsc2.length == 0 && cursosinscp2.length == 0){
            Swal.fire({
                type: 'error',
                title: 'Deve selecionar ao menos um curso.',                        
              }) 
          }
          else{          
                var url = "./controlador/inscricao.php";
                axios.post(url, {opcao:-5,bi:bi,ano:ano,cursos:cursosinsc2,cursosp:cursosinscp2}).then(response =>{
                    var aux = response.data;
                    if(aux == "1"){
                      this.listarInscriocoes();   
                      document.getElementById('bialunoinscrever2').value = "";
                      document.getElementById('cursosinscricao2').value = "";  
                       document.getElementById('cursosinscricaop2').value = "";                                                   
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
                      $('#inseririnscricaoModal2').modal('hide');  
                    }
                    else if(aux == "0"){
                       Swal.fire({
                        type: 'error',
                        title: 'Este aluno não fui inscrito na primeira convocatória',                        
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
        axios.post(url, {opcao:-6,bi:this.bi,ano:this.ano}).then(response =>{
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
              $('#excluirinscricaoModal2').modal('hide'); 
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
        axios.post(url, {opcao:-3}).then(response =>{
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
      axios.post(url, {opcao:-7,bi:bi,ano:ano,perido:'Regular'}).then(response =>{
         this.cursosinscribidos = response.data;       
      });
      var url3 = "./controlador/inscricao.php";
      axios.post(url3, {opcao:-7,bi:bi,ano:ano,perido:'Pos Laboral'}).then(response =>{
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
        axios.post(url, {opcao:-4,bi:this.procurarbiincrivir}).then(response =>{
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

/*----------------------Turmas 2--------------------------------------------*/
var formarturmas = new Vue({
  el:"#turmas2",
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
      axios.post(url, {opcao:-1,quantidade:this.quantidade,pos:posicao,curso:this.curso,ano:this.ano,periodo:this.periodo}).then(response =>{
         this.lista = response.data;                
      });
      var url2 = "./controlador/turmas.php";
      axios.post(url2, {opcao:-2,curso:this.curso,ano:this.ano,periodo:this.periodo}).then(response =>{
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
      axios.post(url, {opcao:-3,curso:this.curso,ano:this.ano,periodo:this.periodo}).then(response =>{
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
          axios.post(url, {opcao:-1,quantidade:this.quantidade,pos:posicao,curso:this.curso,ano:this.ano,periodo:this.periodo}).then(response =>{
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
          axios.post(url, {opcao:-1,quantidade:this.quantidade,pos:posicao,curso:this.curso,ano:this.ano,periodo:this.periodo}).then(response =>{
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
/*----------------------NOTAS # 2--------------------------------------------*/
var notas1 = new Vue({
  el:"#notas2",
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
              axios.post(url3, {opcao:-2,ano:this.ano,curso:this.curso,periodo:this.periodo}).then(response =>{
                 this.listanotas = response.data;             
               });

            });
        });
    }, 
    listarNotas: async function(){
        this.procurarbi = '';
        var url3 = "./controlador/nota.php";
        axios.post(url3, {opcao:-2,ano:this.ano,curso:this.curso,periodo:this.periodo}).then(response =>{
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
          axios.post(url, {opcao:-1,bi:bi,ano:this.ano,curso:this.curso,periodo:this.periodo,nota:nota}).then(response =>{
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
      axios.post(url, {opcao:-3,ano:this.ano,curso:this.curso,periodo:this.periodo,bi:this.binota1}).then(response =>{
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
          axios.post(url, {opcao:-4,bi:this.bia,ano:this.ano,curso:this.curso,periodo:this.periodo,nota:this.notaa}).then(response =>{
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
        axios.post(url, {opcao:-5,ano:this.ano,curso:this.curso,periodo:this.periodo,bi:this.procurarbi}).then(response =>{
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
/*----------------------Publicar notas # 2--------------------------------------------*/
var publicarnota2 = new Vue({
  el:"#publicarnota2",
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
        axios.post(url3, {opcao:-6,ano:this.ano,curso:this.curso,periodo:this.periodo}).then(response =>{
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
/*-----------------------------------Realatorios-------------------------*/
var relatorio1= new Vue({
  el:"#relatorio1",
  data:{
    lista:[],
    lista2:[],
    insc:'',
    paga:'',
    data:'',
    totalinscpordata:''            
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
    quantidadeInscporData:async function(){
      this.data = document.getElementById('daterel1').value;
      var url = "./controlador/relatorios.php";
      axios.post(url, {opcao:8,data:this.data}).then(response =>{
         this.lista = response.data;
         this.TotalInscporData();                  
      });
    },
    TotalInscporData:async function(){
      this.data = document.getElementById('daterel1').value;
      var url = "./controlador/relatorios.php";
      axios.post(url, {opcao:9,data:this.data}).then(response =>{
         this.totalinscpordata = response.data;                   
      });
    }

  },
  created: function(){
      this.quantidadeInsc();
      this.quantidadePagamentos();
      this.quantidadePagamentosInsc();
      this.TotalInscporData();
   }

});
/******Relatorio2*****/
var relatorio2= new Vue({
  el:"#relatorio2",
  data:{
    lista:[]          
  },
  methods:{
    InscsimPagar:async function(){
      var url = "./controlador/relatorios.php";
      axios.post(url, {opcao:7}).then(response =>{
         this.lista = response.data;                   
      });
    }
  },
  created: function(){
      this.InscsimPagar();         
   }

});
/*******Relatorio3******/
var relatorio3= new Vue({
  el:"#relatorio3",
  data:{
    listaQuantCursos:[],
    listaQuantCursosII:[],
    cursossexo:[],
    cursoaprovados:[],
    listaQuantProcedencia:[],
    listaQuantProcedenciaII:[],
    cursoaprovadosII:[],
    tabela3OP:[],
    tabela3CC:[],
    ano:'2020',
    masdeuncurso:'0',
    pormasdeuncurso:'0',
    masdeunperiodo:'0',
    pormasdeunperiodo:'0',
    adop:0,
    naoadop:0,
    totalop:0,
    taxaop:'0',
    adcc:0,
    naoadcc:0,
    totalcc:0,
    taxacc:'0',
    taxageral:'0',
    porinscop:'0',
    poradop:'0',
    porinsccc:'0',
    poradcc:'0'
  },
  methods:{
    EmMasDeUnCursoPeriodo:async function(){
      var url = "./controlador/relatorios2.php";
      axios.post(url, {opcao:25,ano:this.ano}).then(response =>{
         this.masdeuncurso = response.data.masdeuncurso; 
         this.pormasdeuncurso = response.data.pormasdeuncurso; 
         this.masdeunperiodo = response.data.masdeunperiodo;  
         this.pormasdeunperiodo = response.data.pormasdeunperiodo;                
      });
    },
    Tabla3OP:async function(){
      var url = "./controlador/relatorios2.php";
      axios.post(url, {opcao:26,ano:this.ano}).then(response =>{
         this.tabela3OP = response.data; 
         for (var i = 0; i < this.tabela3OP.length; i++) {
             this.adop+=parseInt(this.tabela3OP[i].admitidos);
             this.naoadop+=parseInt(this.tabela3OP[i].naoadmitidos) ;
             this.totalop+=parseInt(this.tabela3OP[i].total);
          } 
          var aux1 = (this.adop*100)/this.totalop;  
          this.taxaop = aux1.toFixed(2);                    
      });
    },
    Tabla3CC:async function(){
      var url = "./controlador/relatorios2.php";
      axios.post(url, {opcao:27,ano:this.ano}).then(response =>{
         this.tabela3CC = response.data; 
         for (var i = 0; i < this.tabela3CC.length; i++) {
             this.adcc+=parseInt(this.tabela3CC[i].admitidos);
             this.naoadcc+=parseInt(this.tabela3CC[i].naoadmitidos) ;
             this.totalcc+=parseInt(this.tabela3CC[i].total);
          } 

          var aux2 = (this.adcc*100)/this.totalcc;   
          this.taxacc = aux2.toFixed(2);   

          var aux3 = ((this.adcc + this.adop)*100) / (this.totalop+this.totalcc);
          this.taxageral = aux3.toFixed(2);

          var aux4 = (this.totalop*100)/ (this.totalop+this.totalcc);
          this.porinscop = aux4.toFixed(2);
          var aux5 = (this.totalcc*100)/ (this.totalop+this.totalcc);
          this.porinsccc = aux5.toFixed(2);

          var aux6 = (this.adop*100)/ (this.adop+this.adcc);
          this.poradop = aux6.toFixed(2);
          var aux7 = (this.adcc*100)/ (this.adop+this.adcc);
          this.poradcc = aux7.toFixed(2);


      });
    },
    inscricaoporCursos:async function(){
      var url = "./controlador/relatorios2.php";
      axios.post(url, {opcao:1,ano:this.ano}).then(response =>{
         this.listaQuantCursos = response.data;                   
      });
    },
    inscricaoporCursosII:async function(){
      var url = "./controlador/relatorios2.php";
      axios.post(url, {opcao:7,ano:this.ano}).then(response =>{
         this.listaQuantCursosII = response.data;                   
      });
    },
    cursosSexo:async function(){
      var url = "./controlador/relatorios2.php";
      axios.post(url, {opcao:2,ano:this.ano}).then(response =>{
         this.cursossexo = response.data;                   
      });
    },
    cursosAprovados:async function(){
      var url = "./controlador/relatorios2.php";
      axios.post(url, {opcao:3,ano:this.ano}).then(response =>{
         this.cursoaprovados = response.data;                   
      });
    },
    ResultadosporCursoAVG:async function(){
      var url = "./controlador/relatorios2.php";
      axios.post(url, {opcao:4,ano:this.ano}).then(response =>{
         this.listaQuantProcedencia = response.data;                   
      });
    },
    ResultadosporCursoAVGII:async function(){
      var url = "./controlador/relatorios2.php";
      axios.post(url, {opcao:5,ano:this.ano}).then(response =>{
         this.listaQuantProcedenciaII = response.data;                   
      });
    },
    cursosAprovadosII:async function(){
      var url = "./controlador/relatorios2.php";
      axios.post(url, {opcao:6,ano:this.ano}).then(response =>{
         this.cursoaprovadosII = response.data;                   
      });
    },
    reiniciar:async function(){
      this.inscricaoporCursos(); 
      this.inscricaoporCursosII(); 
      this.cursosSexo();
      this.cursosAprovados();
      this.cursosAprovadosII();
      this.ResultadosporCursoAVG(); 
      this.ResultadosporCursoAVGII(); 
      this.EmMasDeUnCursoPeriodo();
      this.Tabla3OP();
      this.Tabla3CC();
    }
  },
  created: function(){
    this.reiniciar();            
   }

});
/*********Relatorio 4********* */
var relatorio4= new Vue({
  el:"#relatorio4",
  data:{
    lista:[]
             
  },
  methods:{
    quantidadeInsc:async function(){
      var url = "./controlador/relatorios.php";
      axios.post(url, {opcao:17}).then(response =>{
         this.lista = response.data;                   
      });
    }
  },
  created: function(){
      this.quantidadeInsc();    
   }

});
/****RELATORIO # 6 ***********/
var relatorio6 = new Vue({
  el:"#relatorio5",
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
        axios.post(url3, {opcao:-8,ano:this.ano,curso:this.curso,periodo:this.periodo}).then(response =>{
           this.listanotas = response.data;
        });
    },     
    Imprimir:async function(){
       this.printTabela('exportarnotasadmitidos');
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
/****RELATORIO # 5 ***********/
var relatorio5 = new Vue({
  el:"#relatorio6",
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
        axios.post(url3, {opcao:-9,ano:this.ano,curso:this.curso,periodo:this.periodo}).then(response =>{
           this.listanotas = response.data;
        });
    },     
    Imprimir:async function(){
       this.printTabela('exportarnotasadmitidos');
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
/*******Relatorio 7******/
var relatorio7= new Vue({
  el:"#relatorio7",
  data:{   
    listaQuantProcedencia:[],
    listaQuantProcedenciaProm:[],
    listaQuantProcedenciaPromII:[],
    listaResultadosProcedenciaI:[],
    listaResultadosProcedenciaII:[],       
    ano:'2020'         
  },
  methods:{
    procedencia:async function(){
      var url = "./controlador/relatorios2.php";
      axios.post(url, {opcao:8,ano:this.ano}).then(response =>{
         this.listaQuantProcedencia = response.data;           
                           
      });
    },
    procedenciaPromedio:async function(){
      var url = "./controlador/relatorios2.php";
      axios.post(url, {opcao:9,ano:this.ano}).then(response =>{
         this.listaQuantProcedenciaProm = response.data;           
                           
      });
    },
    procedenciaPromedioII:async function(){
      var url = "./controlador/relatorios2.php";
      axios.post(url, {opcao:10,ano:this.ano}).then(response =>{
         this.listaQuantProcedenciaPromII = response.data;           
                           
      });
    },
    resultadosI:async function(){
      var url = "./controlador/relatorios2.php";
      axios.post(url, {opcao:11,ano:this.ano}).then(response =>{
         this.listaResultadosProcedenciaI = response.data;                           
      });
    },
    resultadosII:async function(){
      var url = "./controlador/relatorios2.php";
      axios.post(url, {opcao:12,ano:this.ano}).then(response =>{
         this.listaResultadosProcedenciaII = response.data;        
                           
      });
    },
    reiniciar:async function(){
      this.procedencia();
      this.procedenciaPromedio();
      this.procedenciaPromedioII();
      this.resultadosI();
      this.resultadosII();
    }
   
  },
  created: function(){
    this.reiniciar();            
   }

});
/*******Relatorio 8******/
var relatorio8= new Vue({
  el:"#relatorio8",
  data:{
    listaQuantEnsinoMedio:[],   
    mediaporcursosI:[],      
    mediaporcursosII:[],
    listaResultadosCursosProcedenciaI:[],
    listaResultadosCursosProcedenciaII:[],
    listaQuantProv:[],
    listamediaprovinciasI:[],
    listamediaprovinciasII:[],
    ano:'2020'         
  },
  methods:{
    ensinomedio:async function(){
      var url = "./controlador/relatorios2.php";
      axios.post(url, {opcao:13,ano:this.ano}).then(response =>{
         this.listaQuantEnsinoMedio = response.data;                          
      });
    },
    mediaporcursodeprocedencia:async function(){
      var url = "./controlador/relatorios2.php";
      axios.post(url, {opcao:14,ano:this.ano}).then(response =>{
         this.mediaporcursosI = response.data;                           
      });
    },  
    mediaporcursodeprocedenciaII:async function(){
      var url = "./controlador/relatorios2.php";
      axios.post(url, {opcao:15,ano:this.ano}).then(response =>{
         this.mediaporcursosII = response.data;                           
      });
    }, 
    resultadosI:async function(){
      var url = "./controlador/relatorios2.php";
      axios.post(url, {opcao:16,ano:this.ano}).then(response =>{
         this.listaResultadosCursosProcedenciaI = response.data;                           
      });
    },   
    resultadosII:async function(){
      var url = "./controlador/relatorios2.php";
      axios.post(url, {opcao:17,ano:this.ano}).then(response =>{
         this.listaResultadosCursosProcedenciaII = response.data;                           
      });
    },  
    inscricaoporProvincias:async function(){
      var url = "./controlador/relatorios2.php";
      axios.post(url, {opcao:18,ano:this.ano}).then(response =>{
         this.listaQuantProv = response.data;                           
      });
    }, 
    mediaporProvincias:async function(){
      var url = "./controlador/relatorios2.php";
      axios.post(url, {opcao:19,ano:this.ano}).then(response =>{
         this.listamediaprovinciasI = response.data;                           
      });
    }, 
    mediaporProvinciasII:async function(){
      var url = "./controlador/relatorios2.php";
      axios.post(url, {opcao:20,ano:this.ano}).then(response =>{
         this.listamediaprovinciasII = response.data;                           
      });
    }, 
    reiniciar:async function(){
      this.ensinomedio();
      this.mediaporcursodeprocedencia();
      this.mediaporcursodeprocedenciaII();
      this.resultadosI();
      this.resultadosII();
      this.inscricaoporProvincias();
      this.mediaporProvincias();
      this.mediaporProvinciasII();
    }   
  },
  created: function(){
    this.reiniciar();            
   }

});
/*******Relatorio 8******/
var relatorio8= new Vue({
  el:"#relatorio9",
  data:{   
    listaQuantProv:[],
    listamediaprovinciasI:[],
    listamediaprovinciasII:[],
    listaResultadosProvincias:[],
    listaResultadosProvinciasII:[],
    ano:'2020'         
  },
  methods:{   
    inscricaoporProvincias:async function(){
      var url = "./controlador/relatorios2.php";
      axios.post(url, {opcao:18,ano:this.ano}).then(response =>{
         this.listaQuantProv = response.data;                           
      });
    }, 
    mediaporProvincias:async function(){
      var url = "./controlador/relatorios2.php";
      axios.post(url, {opcao:19,ano:this.ano}).then(response =>{
         this.listamediaprovinciasI = response.data;                           
      });
    }, 
    mediaporProvinciasII:async function(){
      var url = "./controlador/relatorios2.php";
      axios.post(url, {opcao:20,ano:this.ano}).then(response =>{
         this.listamediaprovinciasII = response.data;                           
      });
    }, 
    resultadosProvinciasI:async function(){
      var url = "./controlador/relatorios2.php";
      axios.post(url, {opcao:21,ano:this.ano}).then(response =>{
         this.listaResultadosProvincias = response.data;                           
      });
    }, 
    resultadosProvinciasII:async function(){
      var url = "./controlador/relatorios2.php";
      axios.post(url, {opcao:22,ano:this.ano}).then(response =>{
         this.listaResultadosProvinciasII = response.data;                           
      });
    }, 
    reiniciar:async function(){      
      this.inscricaoporProvincias();
      this.mediaporProvincias();
      this.mediaporProvinciasII();
      this.resultadosProvinciasI();
      this.resultadosProvinciasII();
    }   
  },
  created: function(){
    this.reiniciar();            
   }

});
/*----------------------------Funcoes JavaScript------------------------------ */
function pulsar(e){
  if(e.which === 13 && !e.shiftKey){
    e.preventDefault();
    return false;
  }
}

$(document).on('shown.bs.modal', '.modal', function () {
    $(this).find("input:visible:first").focus();
});

