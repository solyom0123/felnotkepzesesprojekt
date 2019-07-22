
class Vizsga_Model {
    //osztalyvaltozok:
    //tipus: milyen tipusu vizsga
    //oraszam: mennyivizsgavan
    
    /**
     * 
     * @param {type} tipus
     * @param {type} szamitott_oraszam
     * @returns {Vizsga_Model}
     */
    constructor(tipus,oraszam
    ){
    this.tipus=tipus; 
    this.oraszam=oraszam;
    this.used = false;
    }
    
    getTipus(){
        return this.tipus;
    }
    getUsed(){
        return this.used;
    }
    
    setUsed(used){
        return this.used =used;
    }
    getOraszam(){
        return this.oraszam;
    }
  
}