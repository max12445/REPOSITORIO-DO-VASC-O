import './style.css'
import { useState } from 'react';


export default function contador(){
    let [resultado, setResultado] = useState("Falso");
    // const [num, setNum] = useState(0);
    
    //function incrementar(){
    //     setNum(num + 1);
    // }
    // function decrementar(){
    //     setNum(num + 1);
    // }

    function verificar(valor){
        if(valor>=10){
            setResultado("Verdadeiro")
        }
        else{
            setResultado("Falso")
        }
    }

    return(
        // <div className='pagina'>
        // <h1 className='p'>Contador</h1>
        // <button onClick={incrementar}>+</button>
        // <p>{num}</p>
        // <button onClick={decrementar}>-</button>
        // </div>

        
        <div className='pagina'>
        <h3> É maior que 10?</h3>
        <input type='text' onChange={(e) => verificar(e.target.value)}/>
        <p>{resultado}</p>
        </div>
    )
}