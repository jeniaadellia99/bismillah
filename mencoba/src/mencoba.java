
import comboboxdb.ModelsLab;
import java.awt.List;
import java.awt.Toolkit;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.SQLException;
import java.sql.Statement;
import java.sql.ResultSet;
import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Calendar;
import java.util.logging.Level;
import java.util.logging.Logger;
import javax.swing.DefaultComboBoxModel;
import javax.swing.JComboBox;
import javax.swing.JFrame;
import javax.swing.JOptionPane;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author lenovo
 */
public class mencoba extends javax.swing.JFrame {

    private int id;
    private String tglkl;
    private ArrayList<Integer> id_lab = new ArrayList<Integer>();
    
    

    ArrayList<ModelsLab> Mlab = new ArrayList<>();
    private Object st;
    
    /**
     * Creates new form mencoba
     */
    public mencoba() {
        setIcon();
//        setModel();
        initComponents();
        tampil();
        
        
        setDefaultCloseOperation(JFrame.DO_NOTHING_ON_CLOSE);
        tftgl.setText(mencoba.now());
        tglkl = String.valueOf(mencoba.now());
        
//        JComboBox combobox = new JComboBox();
//        combobox.addItem("Agung");
//        combobox.addItem("Jenii");
//        for (int i=1;i<=10;i++){
//            combobox.addItem(i);
//        }
    }
    /**
     * This method is called from within the constructor to initialize the form.
     * WARNING: Do NOT modify this code. The content of this method is always
     * regenerated by the Form Editor.
     */
    @SuppressWarnings("unchecked")
    // <editor-fold defaultstate="collapsed" desc="Generated Code">//GEN-BEGIN:initComponents
    private void initComponents() {

        jPanel1 = new javax.swing.JPanel();
        jPanel4 = new javax.swing.JPanel();
        jPanel2 = new javax.swing.JPanel();
        jLabel2 = new javax.swing.JLabel();
        jLabel3 = new javax.swing.JLabel();
        jLabel4 = new javax.swing.JLabel();
        text2 = new javax.swing.JTextField();
        text4 = new javax.swing.JTextField();
        jButton1 = new javax.swing.JButton();
        jLabel5 = new javax.swing.JLabel();
        tftgl = new javax.swing.JTextField();
        jLabel6 = new javax.swing.JLabel();
        text5 = new javax.swing.JTextField();
        jLabel1 = new javax.swing.JLabel();
        jButton2 = new javax.swing.JButton();
        cbNama = new javax.swing.JComboBox();
        jLabel8 = new javax.swing.JLabel();
        jSpinner1 = new javax.swing.JSpinner();
        jPanel3 = new javax.swing.JPanel();
        jLabel7 = new javax.swing.JLabel();

        jPanel1.setBackground(new java.awt.Color(241, 196, 15));

        javax.swing.GroupLayout jPanel1Layout = new javax.swing.GroupLayout(jPanel1);
        jPanel1.setLayout(jPanel1Layout);
        jPanel1Layout.setHorizontalGroup(
            jPanel1Layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
            .addGap(0, 371, Short.MAX_VALUE)
        );
        jPanel1Layout.setVerticalGroup(
            jPanel1Layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
            .addGap(0, 478, Short.MAX_VALUE)
        );

        jPanel4.setBackground(new java.awt.Color(153, 153, 0));

        javax.swing.GroupLayout jPanel4Layout = new javax.swing.GroupLayout(jPanel4);
        jPanel4.setLayout(jPanel4Layout);
        jPanel4Layout.setHorizontalGroup(
            jPanel4Layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
            .addGap(0, 280, Short.MAX_VALUE)
        );
        jPanel4Layout.setVerticalGroup(
            jPanel4Layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
            .addGap(0, 420, Short.MAX_VALUE)
        );

        setDefaultCloseOperation(javax.swing.WindowConstants.EXIT_ON_CLOSE);
        setUndecorated(true);
        getContentPane().setLayout(new org.netbeans.lib.awtextra.AbsoluteLayout());

        jPanel2.setBackground(new java.awt.Color(255, 255, 255));
        jPanel2.setLayout(new org.netbeans.lib.awtextra.AbsoluteLayout());

        jLabel2.setForeground(new java.awt.Color(255, 255, 255));
        jLabel2.setText("Nama");
        jPanel2.add(jLabel2, new org.netbeans.lib.awtextra.AbsoluteConstraints(270, 130, -1, -1));

        jLabel3.setForeground(new java.awt.Color(255, 255, 255));
        jLabel3.setText("Nama Lab");
        jPanel2.add(jLabel3, new org.netbeans.lib.awtextra.AbsoluteConstraints(270, 180, -1, -1));

        jLabel4.setForeground(new java.awt.Color(255, 255, 255));
        jLabel4.setText("Mata Kuliah");
        jPanel2.add(jLabel4, new org.netbeans.lib.awtextra.AbsoluteConstraints(270, 230, -1, -1));

        text2.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                text2ActionPerformed(evt);
            }
        });
        jPanel2.add(text2, new org.netbeans.lib.awtextra.AbsoluteConstraints(270, 150, 260, -1));
        jPanel2.add(text4, new org.netbeans.lib.awtextra.AbsoluteConstraints(270, 250, 260, -1));

        jButton1.setText("Simpan");
        jButton1.addMouseListener(new java.awt.event.MouseAdapter() {
            public void mouseClicked(java.awt.event.MouseEvent evt) {
                jButton1MouseClicked(evt);
            }
        });
        jButton1.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                jButton1ActionPerformed(evt);
            }
        });
        jPanel2.add(jButton1, new org.netbeans.lib.awtextra.AbsoluteConstraints(320, 340, 140, -1));

        jLabel5.setForeground(new java.awt.Color(255, 255, 255));
        jLabel5.setText("Tanggal");
        jPanel2.add(jLabel5, new org.netbeans.lib.awtextra.AbsoluteConstraints(270, 270, -1, 20));

        tftgl.setEditable(false);
        tftgl.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                tftglActionPerformed(evt);
            }
        });
        jPanel2.add(tftgl, new org.netbeans.lib.awtextra.AbsoluteConstraints(270, 300, 260, -1));

        jLabel6.setBackground(new java.awt.Color(204, 204, 0));
        jLabel6.setFont(new java.awt.Font("Wide Latin", 0, 24)); // NOI18N
        jLabel6.setForeground(new java.awt.Color(255, 255, 255));
        jLabel6.setText("ELABS");
        jPanel2.add(jLabel6, new org.netbeans.lib.awtextra.AbsoluteConstraints(40, 180, -1, -1));

        text5.addKeyListener(new java.awt.event.KeyAdapter() {
            public void keyTyped(java.awt.event.KeyEvent evt) {
                text5KeyTyped(evt);
            }
        });
        jPanel2.add(text5, new org.netbeans.lib.awtextra.AbsoluteConstraints(350, 90, 40, 30));

        jLabel1.setForeground(new java.awt.Color(255, 255, 255));
        jLabel1.setText("No Komputer");
        jPanel2.add(jLabel1, new org.netbeans.lib.awtextra.AbsoluteConstraints(270, 100, -1, -1));

        jButton2.setText("Keluar");
        jButton2.addMouseListener(new java.awt.event.MouseAdapter() {
            public void mouseClicked(java.awt.event.MouseEvent evt) {
                jButton2MouseClicked(evt);
            }
        });
        jButton2.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                jButton2ActionPerformed(evt);
            }
        });
        jPanel2.add(jButton2, new org.netbeans.lib.awtextra.AbsoluteConstraints(610, 380, -1, -1));

        cbNama.setToolTipText("");
        cbNama.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                cbNamaActionPerformed(evt);
            }
        });
        jPanel2.add(cbNama, new org.netbeans.lib.awtextra.AbsoluteConstraints(270, 200, -1, -1));

        jLabel8.setIcon(new javax.swing.ImageIcon(getClass().getResource("/iya.jpeg"))); // NOI18N
        jPanel2.add(jLabel8, new org.netbeans.lib.awtextra.AbsoluteConstraints(-30, -20, -1, -1));
        jPanel2.add(jSpinner1, new org.netbeans.lib.awtextra.AbsoluteConstraints(590, 210, -1, -1));

        getContentPane().add(jPanel2, new org.netbeans.lib.awtextra.AbsoluteConstraints(0, 0, 770, 420));

        jPanel3.setLayout(new java.awt.BorderLayout());
        getContentPane().add(jPanel3, new org.netbeans.lib.awtextra.AbsoluteConstraints(-190, 0, -1, 421));

        jLabel7.setBackground(new java.awt.Color(255, 255, 255));
        jLabel7.setFont(new java.awt.Font("Wide Latin", 3, 24)); // NOI18N
        jLabel7.setForeground(new java.awt.Color(204, 204, 204));
        jLabel7.setText("ELABS");
        getContentPane().add(jLabel7, new org.netbeans.lib.awtextra.AbsoluteConstraints(40, 190, -1, -1));

        pack();
    }// </editor-fold>//GEN-END:initComponents
    
      
//public void tampil_combo(){
//    try{
//         java.sql.Connection con = DriverManager.getConnection("jdbc:mysql://localhost/tugas_akhir", "root", "");
//            Statement smt = con.createStatement();
//            String sql = "select nama from lab ";
//        try (ResultSet rs = st.) {
//            while(rs.next()){
//                Object[] ob = new Object[3];
//                ob[0] = rs.getString(1);
//                ob[1] = rs.getString(1);
//                ob[2] = rs.getString(1);
//                ComboBox.addItem(ob[0]);
//            }
//        }
//    st.close();
//    }catch (Exception e){
//        System.out.printIn(e.getMessage());
//    }
//}

public void tampil(){
        try {
            java.sql.Connection con = DriverManager.getConnection("jdbc:mysql://localhost/tugas_akhir", "root", "");
            Statement smt = con.createStatement();
            String sql = "select * from lab";
            ResultSet res = smt.executeQuery(sql);
            
            while (res.next()) {
                Object[] ob = new Object[3];
//                ob[0] = res.getInt(1);
//                ob[1] = res.getString(2);
                id_lab.add(res.getInt(1));
                cbNama.addItem(res.getString(2));
            }
            res.close();
            smt.close();
        } catch (SQLException ex) {
            Logger.getLogger(mencoba.class.getName()).log(Level.SEVERE, null, ex);
        }
}

    private void jButton1ActionPerformed(java.awt.event.ActionEvent evt) {//GEN-FIRST:event_jButton1ActionPerformed

        // TODO add your handling code here:
        try {
            java.sql.Connection con = DriverManager.getConnection("jdbc:mysql://localhost/tugas_akhir", "root", "");
            Statement smt = con.createStatement();
            

            
            String sql = "insert into pemakaian_lab (id,nama_pengguna,no_komputer,id_lab,mata_kuliah,date) values " + "(NULL,'"+text2.getText()+"','"+text5.getText()+"','"+id_lab.get(cbNama.getSelectedIndex())+"','"+text4.getText()+"','"+mencoba.now() + "') " ;
            //String sql = "insert into pemakaian_lab (id,kode_lab,nama_lab,mata_kuliah,date) values " + "('"+text1.getText()+"', '"+text2.getText()+"', '"+text3.getText()+"', '"text4.getText()"', '"+tanggal+"')";
            smt.executeUpdate(sql, Statement.RETURN_GENERATED_KEYS);
            ResultSet rs=smt.getGeneratedKeys();
		
            if(rs.next()){
                id=rs.getInt(1);
            }
        } catch (SQLException ex) {
            Logger.getLogger(mencoba.class.getName()).log(Level.SEVERE, null, ex);
        }
    }//GEN-LAST:event_jButton1ActionPerformed

    private void jButton1MouseClicked(java.awt.event.MouseEvent evt) {//GEN-FIRST:event_jButton1MouseClicked
        // TODO add your handling code here:
        if (text2.getText().equals("")){
            JOptionPane.showMessageDialog(this, "Nama Harus diisi");
        }else if (cbNama.getSelectedItem().equals("")){
            JOptionPane.showMessageDialog(this, "nama lab Harus diisi");
        }
        else if (text4.getText().equals("")){
            JOptionPane.showMessageDialog(this, "mata kuliah Harus diisi");
                }else{

            JOptionPane.showMessageDialog(this, "Welcome");
            this.setState(this.ICONIFIED);
        }
    }//GEN-LAST:event_jButton1MouseClicked

    private void text2ActionPerformed(java.awt.event.ActionEvent evt) {//GEN-FIRST:event_text2ActionPerformed
        // TODO add your handling code here:
    }//GEN-LAST:event_text2ActionPerformed

    private void tftglActionPerformed(java.awt.event.ActionEvent evt) {//GEN-FIRST:event_tftglActionPerformed
        // TODO add your handling code here:
    }//GEN-LAST:event_tftglActionPerformed

    private void text5KeyTyped(java.awt.event.KeyEvent evt) {//GEN-FIRST:event_text5KeyTyped
        // TODO add your handling code here:
         if(!Character.isDigit(evt.getKeyChar())){
            evt.consume();
        }
    }//GEN-LAST:event_text5KeyTyped

    private void jButton2ActionPerformed(java.awt.event.ActionEvent evt) {//GEN-FIRST:event_jButton2ActionPerformed
        // TODO add your handling code here:
       try {
            java.sql.Connection con = DriverManager.getConnection("jdbc:mysql://localhost/tugas_akhir", "root", "");
      
           String sql = "UPDATE pemakaian_lab set tgl_keluar = ? where id = ?";
           PreparedStatement prep = con.prepareStatement(sql);
           prep.setString(1, mencoba.now());
           prep.setInt(2, id);
           prep.executeUpdate();
           
        } catch (SQLException ex) {
            Logger.getLogger(mencoba.class.getName()).log(Level.SEVERE, null, ex);
        }
    }//GEN-LAST:event_jButton2ActionPerformed

    private void jButton2MouseClicked(java.awt.event.MouseEvent evt) {//GEN-FIRST:event_jButton2MouseClicked
        // TODO add your handling code here:
        int jawab = JOptionPane.showOptionDialog(this, 
                    "Ingin Keluar?", 
                    "Keluar", 
                    JOptionPane.YES_NO_OPTION, 
                    JOptionPane.QUESTION_MESSAGE, null, null, null);
    
    if(jawab == JOptionPane.YES_OPTION){
        JOptionPane.showMessageDialog(this, "Program akan Keluar");
        System.exit(0);
    }
    }//GEN-LAST:event_jButton2MouseClicked

    private void cbNamaActionPerformed(java.awt.event.ActionEvent evt) {//GEN-FIRST:event_cbNamaActionPerformed
        // TODO add your handling code here:
    }//GEN-LAST:event_cbNamaActionPerformed

    /**
     * @param args the command line arguments
     */
    public static void main(String args[]) {
        /* Set the Nimbus look and feel */
        //<editor-fold defaultstate="collapsed" desc=" Look and feel setting code (optional) ">
        /* If Nimbus (introduced in Java SE 6) is not available, stay with the default look and feel.
         * For details see http://download.oracle.com/javase/tutorial/uiswing/lookandfeel/plaf.html 
         */
        try {
            for (javax.swing.UIManager.LookAndFeelInfo info : javax.swing.UIManager.getInstalledLookAndFeels()) {
                if ("Nimbus".equals(info.getName())) {
                    javax.swing.UIManager.setLookAndFeel(info.getClassName());
                    break;
                }
            }
        } catch (ClassNotFoundException ex) {
            java.util.logging.Logger.getLogger(mencoba.class.getName()).log(java.util.logging.Level.SEVERE, null, ex);
        } catch (InstantiationException ex) {
            java.util.logging.Logger.getLogger(mencoba.class.getName()).log(java.util.logging.Level.SEVERE, null, ex);
        } catch (IllegalAccessException ex) {
            java.util.logging.Logger.getLogger(mencoba.class.getName()).log(java.util.logging.Level.SEVERE, null, ex);
        } catch (javax.swing.UnsupportedLookAndFeelException ex) {
            java.util.logging.Logger.getLogger(mencoba.class.getName()).log(java.util.logging.Level.SEVERE, null, ex);
        }
        //</editor-fold>

        /* Create and display the form */
        java.awt.EventQueue.invokeLater(new Runnable() {
            public void run() {
                new mencoba().setVisible(true);
                
                
                
            }
        });
    }

    // Variables declaration - do not modify//GEN-BEGIN:variables
    private javax.swing.JComboBox cbNama;
    private javax.swing.JButton jButton1;
    private javax.swing.JButton jButton2;
    private javax.swing.JLabel jLabel1;
    private javax.swing.JLabel jLabel2;
    private javax.swing.JLabel jLabel3;
    private javax.swing.JLabel jLabel4;
    private javax.swing.JLabel jLabel5;
    private javax.swing.JLabel jLabel6;
    private javax.swing.JLabel jLabel7;
    private javax.swing.JLabel jLabel8;
    private javax.swing.JPanel jPanel1;
    private javax.swing.JPanel jPanel2;
    private javax.swing.JPanel jPanel3;
    private javax.swing.JPanel jPanel4;
    private javax.swing.JSpinner jSpinner1;
    private javax.swing.JTextField text2;
    private javax.swing.JTextField text4;
    private javax.swing.JTextField text5;
    private javax.swing.JTextField tftgl;
    // End of variables declaration//GEN-END:variables

    private void setIcon() {
        setIconImage(Toolkit.getDefaultToolkit().getImage(getClass().getResource("Elabs.jpg")));
    }
    
    public static String now() {
    String tampilan = "yyyy-MM-dd HH:mm:ss" ;
    Calendar cal = Calendar.getInstance();
    SimpleDateFormat sdf = new SimpleDateFormat(tampilan);
    return sdf.format(cal.getTime());

  }
//
//  private void setModel() {
//        try {
//            java.sql.Connection con = DriverManager.getConnection("jdbc:mysql://localhost/tugas_akhir", "root", "");
//        Statement st = con.createStatement();
//            ResultSet rs = st.executeQuery("select id , nama from lab");
//            while(rs.next()){
//      //  ComboBox.addItem(getString)
//            }
//        } catch (Exception e){
//        e.printStackTrace();
//        }
//}

   
}



