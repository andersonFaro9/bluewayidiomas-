import React, { useState } from "react";
import './styles.css';
import logoImg from "../../assets/logo.png";
import { Link, useHistory } from 'react-router-dom';
import { FiArrowLeft } from 'react-icons/fi';
import api from '../../services/api';


export default function Register() {

    const [name, setName] = useState('');
    const [email, setEmail] = useState('');
    const [whatsapp, setWhatsapp] = useState('');
    const [city, setCity] = useState('');
    const [uf, setUf] = useState('');

    const history = useHistory();


    async function handleRegister(e) {
        e.preventDefault();

        const data = {
            name,
            email,
            whatsapp,
            city,
            uf
        };

        try {
            const response = await api.post('ongs', data);
            alert(`Sua id de acesso: ${response.data.id}`);
            history.push('/');
        } catch (err) {
            alert(`Erro no cadastro`);
        }




    }

    return (
        <div className="register-container">
            <div className="content">
                <section>
                    <img src={logoImg} alt="Be The Hero" />
                    <h1>Cadastro</h1>
                    <p>Faça o seu cadastro, entre na plataforma e facilite o aprendizado do aluno.</p>
                    <Link className="back-link" to="/">
                        <FiArrowLeft size={16} color="#E02041" />
                            Não tenho cadastro
                        </Link>
                </section>
                <form onSubmit={handleRegister}>

                    <input placeholder="Nome do professor"
                        value={name}
                        onChange={e => setName(e.target.value)}
                    />
                    <input type="email" placeholder="E-mail do professor"

                        value={email}
                        onChange={e => setEmail(e.target.value)}
                    />
                    <input placeholder="Whatsapp"
                        value={whatsapp}
                        onChange={e => setWhatsapp(e.target.value)}
                    />

                    <div className="input-group">
                        <input placeholder="Cidade"
                            value={city}
                            onChange={e => setCity(e.target.value)}
                        />
                        <input placeholder="UF"
                            style={{ with: 80 }}
                            value={uf}
                            onChange={e => setUf(e.target.value)}

                        />
                    </div>
                    <button type="submit" className="button"> Cadastrar </button>

                </form>
            </div>

        </div>
    );

}