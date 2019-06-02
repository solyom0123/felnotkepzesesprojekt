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
    constructor(belsoazon,kezdes,vizsgakezdes,vizsgaJelentkezes,tartaleknapok){
       this.belsoAzonosito= belsoazon;
       this.kepzes;
       this.kezdes=kezdes;
       this.vizsgaKezdes=vizsgakezdes;
       this.vizsgaJelentkezes=vizsgaJelentkezes;
       this.befejezes;
       this.tartaleknapok=tartaleknapok;
       this.het = new Array();
       this.utemtervnek = new Array();
       this.kizart_napok = new Array();
    }
    getMindenModulMegvolt(){
        var megvolt= true;
        for (var i = 0, max = this.kepzes.getModulok().length; i < max; i++) {
            var aktmodul = this.kepzes.getModulok()[i];
            for (var j = 0, maxj = aktmodul.getTananyagegysegek().length; j < maxj; j++) {
                var aktegyseg = aktmodul.getTananyagegysegek()[j];
                if (aktegyseg.getMegmaradtElmelet()!=0 || aktegyseg.getMegmaradtGyakorlat()!=0 ) {
                    megvolt =false;
                }
            }
        }
        return megvolt;
    }
    getBelsoAzonosito(){
        return this.belsoAzonosito;
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
    
    setbefejezes(befejezes){
         this.kepzes= befejezes;
    }
    
    
    
    gettartaleknapok(){
        return this.tartaleknapok;
    }
    
    gethet(){
        return this.het;
    }
    getutemterv(){
        return this.utemterv;
    }
    
    getkizartnapok(){
        return this.kizart_napok;
    }
    
    
    
}