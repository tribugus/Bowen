import { Injectable } from '@angular/core';
import { BehaviorSubject } from 'rxjs';


const body = document.getElementsByClassName("body");

@Injectable({
  providedIn: 'root',
})
export class LoadingService {
  private _loading = new BehaviorSubject<boolean>(false);
  public readonly loading$ = this._loading.asObservable();
  

  constructor() {}

  show() {

    this.bluron(body);

    /* setTimeout(()=>{
      body[0].classList.remove("blur");
    },500); */
    /* body = body[0];
    body.srcElement.classList.remove("rotate");
    setTimeout(()=>{
      body.srcElement.classList.add("rotate");
    },0);*/


    this._loading.next(true);
  }

  hide() {
    this.bluroff(body);
    this._loading.next(false);
  }

  bluron($e:any){
    $e[0].classList.add("blur");
  }

  bluroff($e:any){
    $e[0].classList.remove("blur");
  }

}