class Usuario {
  constructor(nome, data_nascimento, cidade, estado, email, senha, cep, rua, complemento, numero, bairro, user) {
    this.nome = nome;
    this.data_nascimento = data_nascimento;
    this.cidade = cidade;
    this.estado = estado;
    this.email = email;
    this.senha = senha;
    this.cep = cep;
    this.rua = rua;
    this.complemento = complemento;
    this.numero = numero;
    this.bairro = bairro;
    this.user = user;
  }
}

module.exports = Usuario;
