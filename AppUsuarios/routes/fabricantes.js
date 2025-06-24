const express = require('express');
const router = express.Router();
const Fabricante = require('../models/Fabricante');

let fabricantes = [];
let nextId = 1;

// Listar todos
router.get('/', (req, res) => {
  res.json(fabricantes);
});

// Buscar por ID
router.get('/:id', (req, res) => {
  const id = parseInt(req.params.id);
  const fabricante = fabricantes.find(f => f.id === id);
  if (!fabricante) return res.status(404).json({ message: 'Fabricante não encontrado' });
  res.json(fabricante);
});

// Inserir
router.post('/', (req, res) => {
  const { nome, endereco, documento } = req.body;
  const fabricante = new Fabricante(nextId++, nome, endereco, documento);
  fabricantes.push(fabricante);
  res.status(201).json(fabricante);
});

// Editar
router.put('/:id', (req, res) => {
  const id = parseInt(req.params.id);
  const fabricante = fabricantes.find(f => f.id === id);
  if (!fabricante) return res.status(404).json({ message: 'Fabricante não encontrado' });

  const { nome, endereco, documento } = req.body;
  fabricante.nome = nome ?? fabricante.nome;
  fabricante.endereco = endereco ?? fabricante.endereco;
  fabricante.documento = documento ?? fabricante.documento;

  res.json(fabricante);
});

// Excluir
router.delete('/:id', (req, res) => {
  const id = parseInt(req.params.id);
  const index = fabricantes.findIndex(f => f.id === id);
  if (index === -1) return res.status(404).json({ message: 'Fabricante não encontrado' });

  fabricantes.splice(index, 1);
  res.status(204).send();
});

module.exports = router;
