import React, { useState } from "react";
import { Link, useHistory } from "react-router-dom";
import { FiArrowLeft } from "react-icons/fi";

import api from "../../services/api";

import "./styles.css";

import logoImg from "../../assets/logo.png";

export default function NewIncident() {
    const [title, setTitle] = useState("");
    const [turma, setTurma] = useState("");
    const [description, setDescription] = useState("");
    const [value, setValue] = useState("");

    const ongId = localStorage.getItem("ongId");

    const history = useHistory();

    async function handleNewIncident(e) {
        e.preventDefault();

        const data = {
            title,
            description,
            value,
            turma
        };

        try {
            await api.post("/incidents", data, {
                headers: { Authorization: ongId }
            });

            history.push("/profile");
        } catch (err) {
            console.log(err);
            alert("Erro no cadastro, tente novamente");
        }


    }
    return (
        <div className="new-incident-container">
            <div className="content">
                <section>
                    <img src={logoImg} alt="Be The Hero" />
                    <h1>Cadastrar nova atividade</h1>
                    <p>
                        Digite todos os campos ao lado para a atividade do aluno.
                    </p>

                    <Link to="/" className="back-link">
                        <FiArrowLeft size={16} color="#e02041" />
            Voltar para home
          </Link>
                </section>

                <form onSubmit={handleNewIncident}>
                    <input
                        placeholder="Nome da turma"
                        value={turma}
                        onChange={e => setTurma(e.target.value)}
                    />

                    <input
                        placeholder="Título da atividade"
                        value={title}
                        onChange={e => setTitle(e.target.value)}
                    />
                    <textarea
                        placeholder="Descrição da atividade"
                        value={description}
                        onChange={e => setDescription(e.target.value)}
                    />

                    <input
                        className="video"
                        type="file"
                        id="video"
                        value={value}
                        onChange={e => setValue(e.target.value)}

                    />

                    <label for="video">Enviar vídeo</label>

                    <button className="button" type="submit"> Cadastrar </button>
                </form>
            </div>
        </div>
    );
}

