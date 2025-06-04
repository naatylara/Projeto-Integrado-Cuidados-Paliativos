
import java.io.BufferedReader;
import java.io.FileReader;

public class leituraArquivoDoenca {
    public static void main(String[] args) {

        List<doenca> listaDoencas = new ArrayList<>();

        try {
            BufferedReader reader = new BufferedReader(new FileReader("doencas.txt"));
            String linha;

            while ((linha = reader.readLine()) != null) {
                String[] partes = linha.split(";");
                String nome = partes[0];
                ArrayList<String> sintomas = new ArrayList<>(Arrays.asList(partes[1].split(",")));
                String tratamento = partes[2];

                doenca d = new doenca(nome, sintomas, tratamento);
                listaDoencas.add(d); 
            }

            reader.close();

            for (doenca d : listaDoencas) {
                System.out.println("Doença: " + d.getNome());
                System.out.println("Sintomas: " + String.join(", ", d.getSintomas()));
                System.out.println("Tratamento: " + d.getTratamentoPaliativo());
                System.out.println();
            }

        } catch (Exception e) {
            System.out.println("Erro: " + e.getMessage());
        }
    }
}

