// assets/js/script.js
document.addEventListener('DOMContentLoaded', function(){
  const h = document.getElementById('height_cm');
  const w = document.getElementById('weight_kg');
  const out = document.getElementById('bmi_preview');
  if(h && w && out){
    function update(){
      const height = Number(h.value)/100;
      const weight = Number(w.value);
      if(height && weight){
        const bmi = +(weight/(height*height)).toFixed(2);
        let cat = bmi < 18.5 ? 'Underweight' : bmi < 25 ? 'Normal' : bmi < 30 ? 'Overweight' : 'Obese';
        out.textContent = `Preview BMI: ${bmi} — ${cat}`;
      } else out.textContent = '';
    }
    h.addEventListener('input', update); w.addEventListener('input', update);
  }
});

// AJAX helper
async function postJSON(url, data){
  const res = await fetch(url, {method:'POST', headers:{'Content-Type':'application/json'}, body: JSON.stringify(data)});
  return res.json();
}
