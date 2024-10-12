import * as THREE from 'three'
import { OrbitControls } from 'three/examples/jsm/controls/OrbitControls.js'
import * as dat from 'dat.gui'

const renderer = new THREE.WebGLRenderer();
renderer.setSize(window.innerWidth, window.innerHeight);
document.body.appendChild(renderer.domElement);

const scene = new THREE.Scene();

const camera = new THREE.PerspectiveCamera(
    75, //field of view
    window.innerWidth / window.innerHeight,
    0.1, //near clip
    1000 //far clip
);

const orbit = new OrbitControls(camera, renderer.domElement)

const axesHelper = new THREE.AxesHelper(5)
scene.add(axesHelper)

camera.position.set(-10, 30, 30);
orbit.update()

const boxGeometry = new THREE.BoxGeometry()
const boxMaterial = new THREE.MeshBasicMaterial({color: 0x00FF00})
const box = new THREE.Mesh(boxGeometry, boxMaterial)
scene.add(box)

const planeGeometry = new THREE.PlaneGeometry(30,30)
const planeMaterial = new THREE.MeshBasicMaterial({
    color: 0xFFFFFF,        
    side: THREE.DoubleSide
})
const plane = new THREE.Mesh(planeGeometry, planeMaterial)
scene.add(plane)
plane.rotation.x = -0.5 * Math.PI

const gridHelper = new THREE.GridHelper(30, 10) //1: size of the grid, 2: subdivision grid
scene.add(gridHelper)

const sphereGeometry = new THREE.SphereGeometry(4, 40, 40) //1: size, 2 & 3: number of segments
const sphereMaterial = new THREE.MeshBasicMaterial({
    color: 0x0000FF,
    wireframe: false
})

const sphere = new THREE.Mesh(sphereGeometry, sphereMaterial)
scene.add(sphere)

sphere.position.set(-10,10,0)
const options = {
    sphereColor: '#ffea00'
}

gui.addColor(options, 'sphereColor').onChange(function(e){
    sphere.material.color.set(e)
})

const gui = new dat.GUI()

function animate(time){
    box.rotation.x = time / 1000
    box.rotation.z = time / 1000
    renderer.render(scene, camera)
}

renderer.setAnimationLoop(animate)