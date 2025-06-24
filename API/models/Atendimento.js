class Atendimento {
  constructor(doenca, usuario_id, data, sintomas) {
    this.doenca = doenca;
    this.usuario_id = usuario_id;
    this.data = data;
    this.sintomas = sintomas;
  }
}

module.exports = Atendimento;