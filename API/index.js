const express = require('express');
const bodyParser = require('body-parser');
const fs = require('fs');
const path = require('path');
app.use(express.static(path.join(__dirname, 'view'))); //adicionei isso agora

const app = express();
const DATA_FILE = path.join(__dirname, 'usuarios.json');
const ATENDIMENTOS_FILE = path.join(__dirname, 'atendimentos.json');

app.use(bodyParser.json());

//começa aqui
function lerAtendimentos() {
  if (!fs.existsSync(ATENDIMENTOS_FILE)) return [];
  const data = fs.readFileSync(ATENDIMENTOS_FILE, 'utf-8');
  if (!data.trim()) return []; // Se estiver vazio, retorna array vazio
  return JSON.parse(data);
}

function salvarAtendimentos(data) {
  fs.writeFileSync(ATENDIMENTOS_FILE, JSON.stringify(data, null, 2));
}

function getNextAtendimentoId(data) {
  return data.length > 0 ? Math.max(...data.map(a => a.id)) + 1 : 1;
}

//Funções auxiliares para Usuários
function lerUsuarios() {
  if (!fs.existsSync(DATA_FILE)) return [];
  const data = fs.readFileSync(DATA_FILE, 'utf-8');
  return JSON.parse(data);
}

function salvarUsuarios(data) {
  fs.writeFileSync(DATA_FILE, JSON.stringify(data, null, 2));
}

function getNextId(usuarios) {
  return usuarios.length > 0 ? Math.max(...usuarios.map(f => f.id)) + 1 : 1;
}

// Listar 
app.get('/usuarios', (req, res) => {
  const usuarios = lerUsuarios();
  res.json(usuarios);
});

// Buscar 
app.get('/usuarios/:id', (req, res) => {
  const id = parseInt(req.params.id);
  const usuarios = lerUsuarios();
  const usuario = usuarios.find(f => f.id === id);
  if (!usuario) return res.status(404).json({ message: 'Usuário não encontrado' });
  res.json(usuario);
});

// Inserir 
app.post('/usuarios', (req, res) => {
  const {nome, data_nascimento, cidade, estado, email, senha, cep, rua, complemento, numero, bairro, user} = req.body;
  const usuarios = lerUsuarios();
  const novoUsuario = { id: getNextId(usuarios), nome, data_nascimento, cidade, estado, email, senha, cep, rua, complemento, numero, bairro, user};
  usuarios.push(novoUsuario);
  salvarUsuarios(usuarios);
  res.status(201).json(novoUsuario);
});

// Editar 
app.put('/usuarios/:id', (req, res) => {
  const id = parseInt(req.params.id);
  const usuarios = lerUsuarios();
  const usuario = usuarios.find(f => f.id === id);
  if (!usuario) return res.status(404).json({ message: 'Usuário não encontrado' });

  const { nome, data_nascimento, cidade, estado, email, senha, cep, rua, complemento, numero, bairro, user} = req.body;
  usuario.nome = nome ?? usuario.nome;
  usuario.data_nascimento = data_nascimento ?? usuario.data_nascimento;
  usuario.cidade = cidade ?? usuario.cidade;
  usuario.estado = estado ?? usuario.estado;
  usuario.email = email ?? usuario.email;
  usuario.senha = senha ?? usuario.senha;
  usuario.cep = cep ?? usuario.cep;
  usuario.rua = rua ?? usuario.rua;
  usuario.complemento = complemento ?? usuario.complemento;
  usuario.numero = numero ?? usuario.numero;
  usuario.bairro = bairro ?? usuario.bairro;
  usuario.user = user ?? usuario.user;

  salvarUsuarios(usuarios);
  res.json(usuario);
});

// Excluir 
app.delete('/usuarios/:id', (req, res) => {
  const id = parseInt(req.params.id);
  let usuarios = lerUsuarios();
  const index = usuarios.findIndex(u => u.id === id);
  if (index === -1) return res.status(404).json({ message: 'Usuário não encontrado' });

  usuarios.splice(index, 1);
  salvarUsuarios(usuarios);
  res.status(204).send();
});



// Listar todos ou por usuario_id
app.get('/atendimentos', (req, res) => {
  const { usuario_id } = req.query;
  const atendimentos = lerAtendimentos();
  if (usuario_id) {
    const filtrados = atendimentos.filter(a => a.usuario_id == usuario_id);
    return res.json(filtrados);
  }
  res.json(atendimentos);
});

// Buscar atendimento por ID
app.get('/atendimentos/:id', (req, res) => {
  const id = parseInt(req.params.id);
  const atendimentos = lerAtendimentos();
  const atendimento = atendimentos.find(a => a.id === id);
  if (!atendimento) return res.status(404).json({ message: 'Atendimento não encontrado' });
  res.json(atendimento);
});

// Criar atendimento
app.post('/atendimentos', (req, res) => {
  const {doenca, usuario_id, data, sintomas } = req.body;

  const usuarios = lerUsuarios();
  const usuarioExiste = usuarios.some(u => u.id == usuario_id);
  if (!usuarioExiste) {
    return res.status(400).json({ message: 'Usuario não encontrado' });
  }

  const atendimentos = lerAtendimentos();
  const novoAtendimento = {
    id: getNextAtendimentoId(atendimentos),
    doenca,
    usuario_id,
    data,
    sintomas
  };
  atendimentos.push(novoAtendimento);
  salvarAtendimentos(atendimentos);
  res.status(201).json(novoAtendimento);
});

// Editar atendimento
app.put('/atendimentos/:id', (req, res) => {
  const id = parseInt(req.params.id);
  const atendimentos = lerAtendimentos();
  const atendimento = atendimentos.find(a => a.id === id);
  if (!atendimento) return res.status(404).json({ message: 'Atendimento não encontrado' });
  
  const { doenca, usuario_id, data, sintomas } = req.body;
  
  atendimento.doenca = doenca ?? atendimento.doenca;
  atendimento.usuario_id = usuario_id ?? atendimento.usuario_id;
  atendimento.data = data ?? atendimento.data;
  atendimento.sintomas = sintomas ?? atendimento.sintomas;

  salvarAtendimentos(atendimentos);
  res.json(atendimento);
});

// Excluir atendimento
app.delete('/atendimentos/:id', (req, res) => {
  const id = parseInt(req.params.id);
  let atendimentos = lerAtendimentos();
  const index = atendimentos.findIndex(a => a.id === id);
  if (index === -1) return res.status(404).json({ message: 'Atendimento não encontrado' });
  atendimentos.splice(index, 1);
  salvarAtendimentos(atendimentos);
  res.status(204).send();
});


app.listen(3000, () => {
  console.log('Servidor rodando na porta 3000');
});
