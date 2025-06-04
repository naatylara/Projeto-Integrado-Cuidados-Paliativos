public class pessoa {
	private String nomeCompleto;
	private String dataNascimento;
	private String cpf;
	private String endereco;
	private String telefone;
	private String cidade;
	private String estado;
	
	public pessoa() {
		
		
	}

	public pessoa(String nomeCompleto, String dataNascimento, String cpf, String endereco, String telefone,
			String cidade, String estado) {
		
		this.nomeCompleto = nomeCompleto;
		this.dataNascimento = dataNascimento;
		this.cpf = cpf;
		this.endereco = endereco;
		this.telefone = telefone;
		this.cidade = cidade;
		this.estado = estado;
	}

	public String getNomeCompleto() {
		return nomeCompleto;
	}

	public void setNomeCompleto(String nomeCompleto) {
		this.nomeCompleto = nomeCompleto;
	}

	public String getDataNascimento() {
		return dataNascimento;
	}

	public void setDataNascimento(String dataNascimento) {
		this.dataNascimento = dataNascimento;
	}

	public String getCpf() {
		return cpf;
	}

	public void setCpf(String cpf) {
		this.cpf = cpf;
	}

	public String getEndereco() {
		return endereco;
	}

	public void setEndereco(String endereco) {
		this.endereco = endereco;
	}

	public String getTelefone() {
		return telefone;
	}

	public void setTelefone(String telefone) {
		this.telefone = telefone;
	}

	public String getCidade() {
		return cidade;
	}

	public void setCidade(String cidade) {
		this.cidade = cidade;
	}

	public String getEstado() {
		return estado;
	}

	public void setEstado(String estado) {
		this.estado = estado;
	}

	@Override
	public String toString() {
		return "pessoa [nomeCompleto=" + nomeCompleto + ", dataNascimento=" + dataNascimento + ", cpf=" + cpf
				+ ", endereco=" + endereco + ", telefone=" + telefone + ", cidade=" + cidade + ", estado=" + estado
				+ "]";
	}
}