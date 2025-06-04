import java.io.BufferedReader;
import java.io.FileReader;

public class leituraArquivoUsuario {
    public static void main(String[] args) {

        List<usuario> listaUsuarios = new ArrayList<>(); 

        try {

            BufferedReader reader = new BufferedReader(new FileReader("usuarios.txt"));
            String linha;

            while ((linha = reader.readLine()) != null) {
                String[] p = linha.split(",");

                usuario u = new usuario(
                    p[0], p[1], p[2], p[3], p[4], p[5], p[6],
                    Integer.parseInt(p[7]), p[8], p[9], p[10]
                );

                listaUsuarios.add(u); 
            }

            reader.close();

            
            for (usuario u : listaUsuarios) {
                System.out.println(u);
            }

        } catch (Exception e) {
            System.out.println("Erro: " + e.getMessage());
        }
    }
}
