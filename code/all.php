<style>
*{
    margin: 0px;
    padding: 0px;
    border: 0px;
}
:root{
    --yellow:#ffcc00;
    --white:#ffffff;
    --black:#000000;
}
@font-face {
  font-family: "logo_text";
  src: url('../fonts/monster.ttf');
}
@font-face {
  font-family: "h_text";
  src: url('../fonts/graz.ttf');
}
@font-face {
  font-family: "p_text";
  src: url('../fonts/strogo.ttf');
}
header{
    width: 100%;
    height: 80px;
    display: flex;
    background: var(--yellow);
    justify-content: space-between;
    border-bottom: 1px solid var(--black)
}
.logo_box{
    height: 64px;
    display: flex;
    margin: 8px;
}
.logo{
    height: 64px;
    width: 64px;
}
.logo_text{
    font-family: "logo_text";
    color: var(--white);
    font-size: 48px;
    margin: 4px;
    font-weight: 50;
}
h2{
    font-family: "h_text";
    font-size: 48px;
    margin-top: 6px;
}
p, label, a, input, select, span, td, tr{
    font-family: "p_text";
    font-size: 20px;
    margin: auto;
}
table{
    margin: 0;
    padding: 0;
    border-collapse: collapse;
}
td, th{
    border: solid 1px var(--black);
}
img{
    width: 50%;
    border-radius: 16px;
}
.link_menu{
    display: flex;
    list-style-type: none;
    gap: 40px;
    font-family: "h_text";
    margin: 24px;
}
.link{
    color: var(--white);
    font-size: 32px;
    text-decoration: none;
    font-family: "h_text";
}
.img_block{
    width: 100%;
    height: 100%;
    border-radius: 0px;
    border-bottom: 1px solid var(--black)
}
main{
    display: flex;
    width: 100%;
}
.site_content{
    max-width: 1920px;
    margin: 64px auto;
    display: flex;
    flex-direction: column;
    min-height: 792px;
    gap: 64px;
}
.logo_block h1{
    position: absolute;
    top: 25%;
    left: 50%;
    transform: translate(-50%, -50%);
    font-family: "logo_text";
    font-size: 100px;
    margin: 4px;
    font-weight: 50;
}
.pagination{
    margin: 10px auto;
    border: 1px solid var(--black);
    padding: 2px;
    width: 480px;
    display: flex;
    gap: 10px;
}
.container{
    width: 100%-48px;
    border: 1px solid var(--black);
    border-radius:15px;
    display: flex;
    text-align: center;
    flex-direction: column;
    margin: auto 64px;
}
.card{
    border: 1px solid var(--black);
    border-radius:15px;
}
.container_flex{
    display: flex;
    justify-content:space-between;
    border: 1px solid var(--black);
    border-radius:15px;
    margin: 10px;
}
.container_reg{
    display: flex;
    justify-content:space-between;
}
.container_flex div{
    width: 50%;
    margin: auto;
}
.container_lk{
    display: flex;
    justify-content:space-between;
    margin: 10px;
}
.container_lk img{
    width: 256px;
}
.container_lk div{
    margin: auto 20px;
}
.container_catalog{
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    grid-template-rows: repeat(2, 1fr);
    margin: 10px;
    gap: 10px;
    height: 1300px;
}
.container_catalog img{
    width: 856px;
    height: 480px;
    object-fit: cover;
}
.container_grid{
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    grid-template-rows: repeat(2, 1fr);
    border: 1px solid var(--black);
    border-radius:15px;
    margin: 10px;
}
.container_grid img{
    width: 128px;
}
.container_grid p{
    margin: auto;
}
.container_grid div{
    display: flex;
}
footer{
    width: 100%;
    height: 80px;
    display: flex;
    background: var(--yellow);
    justify-content: space-between;
    border-top: 1px solid var(--black)
}
.bye_button{
    border: 0;
    border-left: 1px solid var(--black);
    border-radius: 0 15px 15px 0;
    padding: 0px;
    height: 64px;
    width: 256px;
    margin: 0;
}
input, select{
    border: 1px solid var(--black);
    padding: 2px;
    height: 32px;
    width: 256px;
    margin: 4px 0;
}
tr input{
    border: 0;
    padding: 0;
    height: 32px;
    width: auto;
    margin: 0;
    max-width: 142px;
}
.button{
    border: 1px solid var(--black);
    padding: 2px;
    height: 32px;
    width: 256px;
    margin: auto;
    text-decoration: none;
    color: var(--black)
}
textarea{
    border: 1px solid var(--black);
    padding: 2px;
    height: 256px;
    width: 720px;
    margin: 4px 0;
    font-family: "p_text";
    font-size: 20px;
}
.star {
    font-family: Arial, sans-serif;
    font-size: 20px;
    color: #ccc;
    margin-right: 2px;
}
.star.active {
    color: #ffcc00;
}
.reviews-slider {
    overflow: hidden;
    position: relative;
    width: 100%;
}
.slide {
    display: none;
    padding: 10px;
    margin: 10px 0;
    height: 200px;
    width: 100%-48px;
    border: 1px solid var(--black);
    border-radius:15px;
    text-align: center;
    margin: auto 64px;
}
.slide.active {
    display: block;
}
</style>