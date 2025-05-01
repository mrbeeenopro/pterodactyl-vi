import React, { useEffect, useState } from 'react';
import Fade from '@/components/elements/Fade';
import Portal from '@/components/elements/Portal';
import copy from 'copy-to-clipboard';
import classNames from 'classnames';

interface CopyOnClickProps {
    text: string | number | null | undefined; // Văn bản hoặc số cần sao chép
    showInNotification?: boolean; // Hiển thị thông báo khi sao chép
    children: React.ReactNode; // Phần tử con
}

const CopyOnClick = ({ text, showInNotification = true, children }: CopyOnClickProps) => {
    const [copied, setCopied] = useState(false); // Trạng thái đã sao chép

    useEffect(() => {
        if (!copied) return;

        const timeout = setTimeout(() => {
            setCopied(false); // Đặt lại trạng thái sau 2.5 giây
        }, 2500);

        return () => {
            clearTimeout(timeout); // Xóa timeout khi component bị hủy
        };
    }, [copied]);

    if (!React.isValidElement(children)) {
        throw new Error('Thành phần được truyền vào <CopyOnClick/> phải là một React element hợp lệ.');
    }

    const child = !text
        ? React.Children.only(children)
        : React.cloneElement(React.Children.only(children), {
              className: classNames(children.props.className || '', 'cursor-pointer'), // Thêm lớp CSS
              onClick: (e: React.MouseEvent<HTMLElement>) => {
                  copy(String(text)); // Sao chép văn bản vào clipboard
                  setCopied(true); // Đặt trạng thái đã sao chép
                  if (typeof children.props.onClick === 'function') {
                      children.props.onClick(e); // Gọi hàm onClick của phần tử con (nếu có)
                  }
              },
          });

    return (
        <>
            {copied && (
                <Portal>
                    <Fade in appear timeout={250} key={copied ? 'visible' : 'invisible'}>
                        <div className={'fixed z-50 bottom-0 right-0 m-4'}>
                            <div className={'rounded-md py-3 px-4 text-gray-200 bg-neutral-600/95 shadow'}>
                                <p>
                                    {showInNotification
                                        ? `Đã sao chép "${String(text)}" vào clipboard.`
                                        : 'Đã sao chép văn bản vào clipboard.'}
                                </p>
                            </div>
                        </div>
                    </Fade>
                </Portal>
            )}
            {child}
        </>
    );
};

export default CopyOnClick;
