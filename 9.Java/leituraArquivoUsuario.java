import java.io.BufferedReader;
import java.io.FileReader;
import java.util.ArrayList;
import java.util.List;

public class leituraArquivoUsuario {
    public static void main(String[] args) {

        List<usuario> listaUsuarios = new ArrayList<>(); 

        try {

            BufferedReader reader = new BufferedReader(new FileReader("usuarios.txt"));
            String linha;

            while ((linha = reader.readLine()) != null) {
                String[] p = linha.split(",");

                usuario u = new usuario(
            p[0], // nomeCompleto
            p[1], // dataNascimento
            p[2], // cidade
            p[3], // estado
            p[4], // cep
            p[5], // rua
            p[6], // numero
            p[7], // complemento
            p[8], // bairro
           Integer.parseInt(p[9]), // id
           p[10], // email
           p[11], // user
           p[12]  // senha
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
