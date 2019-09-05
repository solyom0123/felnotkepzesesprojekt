/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


class Aktiv_Kepzes_Model{
    /*
     * osztályváltozók:
     * 
     */
    /**
     * 
     * @param {type} belsoazon
     * @param {type} kezdes
     * @param {type} vizsgakezdes
     * @param {type} vizsgaJelentkezes
     * @param {type} tartaleknapok
     * @returns {Aktiv_Kepzes_Model}
     */
    constructor(id,belsoazon,kepzes,kezdes,vizsgakezdes,vizsgaJelentkezes,tartaleknapok){
       this.id =id;
       this.belsoAzonosito= belsoazon;
       this.kepzes=kepzes;
       this.kezdes=kezdes;
       this.vizsgaKezdes=vizsgakezdes;
       this.vizsgaJelentkezes=vizsgaJelentkezes;
       this.befejezes;
       this.tartaleknapok=tartaleknapok;
       this.het = new Array();
       this.utemterv = new Array();
       this.kizart_napok = new Array();
       this.naptar = new Array();
       this.befejezett_modul = new Array();
    }
   
    getBelsoAzonosito(){
        return this.belsoAzonosito;
    }
    getNaptar(){
        return this.naptar.length;
    }
    
    addNapNaptarhoz(nap){
            this.naptar[this.naptar.length]= nap;
    } 
    getNapNaptarhoz(int){
          return  this.naptar[int];
    }
    getBefejezettModuls(){
        return this.befejezett_modul.length;
    }
    
    addBefejezettModul(no){
            this.befejezett_modul[this.befejezett_modul.length]= no;
    } 
    getBefejezettModul(int){
          return  this.befejezett_modul[int];
    }
    
    getKepzes(){
        return this.kepzes;
    }
    
    setKepzes(kepzes){
         this.kepzes= kepzes;
    }
    
    getKezdes(){
        return this.kezdes;
    }
    getVizsgaKezdes(){
        return this.vizsgaKezdes;
    }
    getVizsgaJelentkezes(){
        return this.vizsgaJelentkezes;
    }
    getbefejezes(){
        return this.befejezes;
    }
    getId(){
        return this.id;
    }
    
    setBefejezes(befejezes){
         this.kepzes= befejezes;
    }
    
    
    
    getTartaleknapok(){
        return this.tartaleknapok;
    }
    
    getHet(){
        return this.het.length;
    }
    getUtemterv(){
        return this.utemterv;
    }
    
    addUtemtervhez(nap){
            this.utemterv[this.utemterv.length]= nap;
    } 
    getUtemtervNap(int){
          return  this.utemterv[int];
    }
    getKizartnapok(){
        return this.kizart_napok.length;
    }
    addKizartnap(nap){
       this.kizart_napok[this.kizart_napok.length]= nap;
    }
    getKizartnap(int){
       return this.kizart_napok[int];
    }
    addWeekDay(nap){
       this.het[this.het.length]= nap;
    }
    getWeekDay(int){
       return this.het[int];
    }
    
}