export default class Utils {
    static api_n29 = "http://servimsa.net/sandbox/api/";
    static api_intra = "https://servimsa.net/intranet/api/";
    static api_sequ = "http://localhost/sequence/api/";
    static Licencia = "ZuOxShfHw3923i5q2el6JLXYP5W01r8Rbw9eG1yspE8U7rA8DMtJMStzD7k9LGHA4j7a4CVNyBg31oFcm6I46nFQK2dKovT5PqiQ";
   
   
    static encode(str: string) { 
        let buf = [];
        for (var i = str.length - 1; i >= 0; i--) {
          buf.unshift(['&#', str[i].charCodeAt(0), ';'].join(''));
        }
        return buf.join('');
    }
    static decode(str: string) { 
        return str.replace(/&#(\d+);/g, function(match, dec) {
            return String.fromCharCode(dec);
        });
    }

    static jsonData(Q: string) { 
        var result = "";
        if(Q=="dataUser"){
           result = Utils.decode(sessionStorage.getItem('_nghost-upu-c16')+"".toString());
        }
        if(Q=="dataMenu"){
            result = Utils.decode(sessionStorage.getItem('_nghost-gmo-c140')+"".toString());
        }
        if(Q=="dataUrls"){
            result = Utils.decode(sessionStorage.getItem('_ngcontent-bor-c16')+"".toString());
        }
        return JSON.parse(result); 
    }

    static removeSessions(){
        sessionStorage.removeItem('_nghost-upu-c16');
        sessionStorage.removeItem('_nghost-gmo-c140');
        sessionStorage.removeItem('_ngcontent-bor-c16');
    }

  
   
  

}