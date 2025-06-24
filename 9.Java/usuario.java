
public class usuario extends pessoa{
	private int id;
    private String email;
    private String user;
    private String senha;
    
	public usuario(String nomeCompleto, String dataNascimento, String cidade, String estado,
               String cep, String rua, String numero, String complemento, String bairro,
               int id, String email, String user, String senha) {

    super(nomeCompleto, dataNascimento, cidade, estado, cep, rua, numero, complemento, bairro);
    this.id = id;
    this.email = email;
    this.user = user;
    this.senha = senha;
}

	public int getId() {
		return id;
	}

	public void setId(int id) {
		this.id = id;
	}

	public String getEmail() {
		return email;
	}

	public void setEmail(String email) {
		this.email = email;
	}

	public String getUser() {
		return user;
	}

	public void setUser(String user) {
		this.user = user;
	}

	public String getSenha() {
		return senha;
	}

	public void setSenha(String senha) {
		this.senha = senha;
	}

	@Override
	public String toString() {
		return "usuario [id=" + id + ", email=" + email + ", user=" + user + ", senha=" + senha + "]";
	}
}
