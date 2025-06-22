public class Atendimento {
    private String doenca;
    private int usuarioId;
    private String data;
    private String sintomas;

    public Atendimento(String doenca, int usuarioId, String data, String sintomas) {
        this.doenca = doenca;
        this.usuarioId = usuarioId;
        this.data = data;
        this.sintomas = sintomas;
    }

    public String getDoenca() {
        return doenca;
    }

    public void setDoenca(String doenca) {
        this.doenca = doenca;
    }

    public int getUsuarioId() {
        return usuarioId;
    }

    public void setUsuarioId(int usuarioId) {
        this.usuarioId = usuarioId;
    }

    public String getData() {
        return data;
    }

    public void setData(String data) {
        this.data = data;
    }

    public String getSintomas() {
        return sintomas;
    }

    public void setSintomas(String sintomas) {
        this.sintomas = sintomas;
    }

    @Override
    public String toString() {
        return "Atendimento - Doença: " + doenca + 
               ", Usuário ID: " + usuarioId + 
               ", Data: " + data + 
               ", Sintomas: " + sintomas;
    }
}
