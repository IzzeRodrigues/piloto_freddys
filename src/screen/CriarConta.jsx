import Navbar from "../components/Navbar";
import empresa from '../assets/images/entertainment.png'
import { useState } from "react";


const CriarConta = () => {
    const [name] = useState('');
    const [email] = useState('');
    const [senha] = useState('');

      return (
        <div className="telaPadrao overflow-hidden bg-amber-50">
            <div className="">
                <Navbar />
            </div>
            <div className="w-8/12 mx-auto">
                <div className="flex justify-center mt-24">
                    <div className="w-6/12 flex justify-center">
                        <img className="" src={empresa} />
                    </div>
                    <div className="w-6/12 flex flex-col ms-[8rem] mt-20 h-full">
                        <p className="font-medium text-3xl">Criar Minha Conta</p>
                        <p className="text-xl mt-8 text-gray-600">Boa! Vamos Começar!</p>
                        <div className="mt-8 ms-12">
                            <form action="http://localhost/api-slim/users" method="get">
                                <div className="flex flex-col justify-evenly h-[20rem]">
                                    <div>
                                        <p className="ms-6 text-lg text-gray-600">Usuário</p>
                                        <input className="placeholder:text-slate-400 bg-white rounded-full shadow-[rgba(17,_17,_26,_0.1)_0px_0px_16px] border focus:outline-none focus:ring-red focus:border-red-300  w-10/12 py-3 px-4" type="text" name="nome" id="nome" value={name} placeholder="Como você quer ser chamado?" />
                                    </div>
                                    <div>
                                        <p className="ms-6 text-lg text-gray-600">Email</p>
                                        <input className="placeholder:text-slate-400 bg-white rounded-full shadow-[rgba(17,_17,_26,_0.1)_0px_0px_16px] border focus:outline-none focus:ring-red focus:border-red-300  w-10/12 py-3 px-4" type="text" name="email" id="email" value={email} placeholder="Insira seu melhor e-mail!" />
                                    </div>
                                    <div>
                                        <p className="ms-6 text-lg text-gray-600">Senha</p>
                                        <input className="placeholder:text-slate-400 bg-white rounded-full shadow-[rgba(17,_17,_26,_0.1)_0px_0px_16px] border focus:outline-none focus:ring-red focus:border-red-300  w-10/12 py-3 px-4" type="password" name="senha" id="senha" value={senha} placeholder="Crie uma senha forte." />
                                    </div>
                                    <div>
                                        <div className="flex flex-col">
                                        <label className="ms-6 text-lg text-gray-600" for="login">Quem é você?</label>
                                            <select className="placeholder:text-slate-400 bg-white rounded-full shadow-[rgba(17,_17,_26,_0.1)_0px_0px_16px] border focus:outline-none focus:ring-red focus:border-red-300  w-10/12 py-3 px-4" name="login" id="login">
                                                <option value="funcionario">Sou Funcionário</option>
                                                <option value="cliente">Sou Cliente</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div className="flex flex-col justify-around h-[12rem]">
                                    <button type="submit" className=" w-10/12 py-3 mt-9 rounded-full bg-black text-white font-semibold">Cadastrar</button>
                                    <button className="font-medium w-10/12">Cadastrar depois</button>
                                    <button className="w-10/12 ">Já tem uma conta?<a href="#" className="underline text-red-700 ms-2">Acesse aqui.</a></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
};

export default CriarConta