public class pessoa {
    private String nomeCompleto;
    private String dataNascimento;
    private String cidade;
    private String estado;
    private String cep;
    private String rua;
    private String numero;
    private String complemento;
    private String bairro;

    public pessoa(String nomeCompleto, String dataNascimento, String cidade, String estado, String cep,
                  String rua, String numero, String complemento, String bairro) {
        this.nomeCompleto = nomeCompleto;
        this.dataNascimento = dataNascimento;
        this.cidade = cidade;
        this.estado = estado;
        this.cep = cep;
        this.rua = rua;
        this.numero = numero;
        this.complemento = complemento;
        this.bairro = bairro;
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

    public String getCep() {
        return cep;
    }

    public void setCep(String cep) {
        this.cep = cep;
    }

    public String getRua() {
        return rua;
    }

    public void setRua(String rua) {
        this.rua = rua;
    }

    public String getNumero() {
        return numero;
    }

    public void setNumero(String numero) {
        this.numero = numero;
    }

    public String getComplemento() {
        return complemento;
    }

    public void setComplemento(String complemento) {
        this.complemento = complemento;
    }

    public String getBairro() {
        return bairro;
    }

    public void setBairro(String bairro) {
        this.bairro = bairro;
    }

    @Override
    public String toString() {
        return "Pessoa - Nome Completo: " + nomeCompleto +
               ", Data Nascimento: " + dataNascimento +
               ", Cidade: " + cidade +
               ", Estado: " + estado +
               ", CEP: " + cep +
               ", Rua: " + rua +
               ", Número: " + numero +
               ", Complemento: " + complemento +
               ", Bairro: " + bairro;
    }
}
