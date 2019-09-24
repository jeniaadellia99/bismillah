/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author lenovo
 */
public class UserSession {
    private static int u_id;
    private static String u_username;
    private static String u_password;
    
    public static int getU_id(){
        return u_id;
    }
    public static void setU_id(int u_id){
           UserSession.u_id = u_id;
    }
    public static String getU_username(){
        return u_username;
    }
    public static void setU_nama(String u_username){
        UserSession.u_username = u_username;
    }
    public static String getU_password(){
        return u_password;
    }
    public static void setU_password(String u_password){
        UserSession.u_password = u_password;
    }
}
