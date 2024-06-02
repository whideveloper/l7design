function openNav() {
    document.getElementById("mySidenav").style.width = "480px";
    document.getElementById("mySidenav").style.opacity = "1";
  }
  
  function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
    document.getElementById("mySidenav").style.opacity = "0";  
  }
  
  function cookies (functions){
      const container = document.querySelector('.cookies-container');
      const saveAllCookie = document.querySelector('.save_cookie_button');
      const savePrefCookie = document.querySelector('.button_modal_req_cookie');    
  
      if(!container || !saveAllCookie || !savePrefCookie) return null
  
      const localPref = JSON.parse(window.localStorage.getItem('cookies-pref'))
      const localAllCookie = JSON.parse(window.localStorage.getItem('cookies'))
  
      if(localPref) activePrefCookie(localPref)
      if(localAllCookie) activeAllCookie(localAllCookie)
      
  //MARCAR TODOS OS INPUTS CASO USUARIO PERMITA TODOS OS COOKIES
      function getFormSelectedAll(){
         var list, index, result;
         var arr = [] 
        list = document.getElementsByClassName("checkbox");
        for (index = 0; index < list.length;) {
          list[index].setAttribute('checked','checked');        
          result = list[index].getAttribute('data-function')
          ++index   
          arr.push(result)     
        }        
        return arr                                          
      }
      //VERIFICA OS COOKIES PERMITIDOS
      function getFormPref(){
        return [...document.querySelectorAll('[data-function]')].filter((el)=> el.checked
        ).map((el)=>el.getAttribute('data-function'))
        
      }
  
  
    function activeAllCookie(allCookie){
      allCookie.forEach((f) => functions[f]());    
      container.style.display = 'none'
      closeNav()
      window.localStorage.setItem('cookies',JSON.stringify(allCookie))    
    }
  
    function activePrefCookie(prefCookie){
      prefCookie.forEach((f) => functions[f]())
      container.style.display = 'none'
      closeNav()
      window.localStorage.setItem('cookies-pref',JSON.stringify(prefCookie))
    }
  
      //TODOS OS COOKIES ATIVOS
      function handleSaveAll(){
          const allCookie = getFormSelectedAll()
          activeAllCookie(allCookie)        
      }
      //VERIFICA AS OPÇÕES ESCOLHIDAS
      function handlePref(){
          const prefCookie = getFormPref()
          activePrefCookie(prefCookie)        
      }
      //REMOVE TODOS OS COOKIES 
      function removeCookie(){
          const removeCookie = getRemove()
          removeAllCookie(removeCookie)
      }
  
  
      saveAllCookie.addEventListener('click',handleSaveAll)
      savePrefCookie.addEventListener('click',handlePref)
  
  }
  
  function useAnalysis(){
    window.location.href
  }
  function necessarily(){
    window.location.href
  }
  function analytics(){
    //CODIGO DO GOOGLE ANALITYCS
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
  
    gtag('config', 'AW-687157588');
  }
  function marketing(){
    //QUALQUER TIPO DE CODIGO VOLTATO AO MARKETING. EX: SPORTY FY, FACEBOOK ADS......
  }
  
  
  
  cookies({
    necessarily,
    useAnalysis,
    analytics,
    marketing
  })