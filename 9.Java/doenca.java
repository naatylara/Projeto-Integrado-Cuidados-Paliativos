import java.util.ArrayList;

public class doenca {
    private String nome;
    private ArrayList<String> sintomas;
    private String tratamentoPaliativo;
    
    public doenca() {
    	
    	
    }

    public doenca(String nome, ArrayList<String> sintomas, String tratamentoPaliativo) {
		super();
		this.nome = nome;
		this.sintomas = sintomas;
		this.tratamentoPaliativo = tratamentoPaliativo;
	}

	public String getNome() {
        return nome;
    }

    public ArrayList<String> getSintomas() {
        return sintomas;
    }

    public String getTratamentoPaliativo() {
        return tratamentoPaliativo;
    }
}