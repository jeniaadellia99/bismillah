/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package comboboxdb;

/**
 *
 * @author lenovo
 */
public class ModelsLab {
    private String id;
    private String nama_lab;

    public ModelsLab(String id,String nama_lab){
        this.id=id;
        this.nama_lab=nama_lab;
    }

    public String toString(){
        return this.nama_lab;
    }

    public String getId() {
        return id;
    }

    public String getNama_lab() {
        return nama_lab;
    }
    
    
}
